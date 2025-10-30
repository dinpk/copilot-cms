<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$q = $_GET['q'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 12;
$offset = ($page - 1) * $limit;
$where = "WHERE file_type = 'images'";
if ($q !== '') {
	$safe_q = $conn->real_escape_string($q);
	$where .= " AND MATCH(alt_text, tags) AGAINST ('$safe_q' IN NATURAL LANGUAGE MODE)";
}
$sql = "SELECT * FROM media_library $where ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
$count_sql = "SELECT COUNT(*) AS total FROM media_library $where";
$total = $conn->query($count_sql)->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);
?>

<div >
	<a href="#" onclick="document.getElementById('media-library-modal').style.display='none'" class="close-icon">✖</a>
	<h3>Select Image from Media Library</h3>
	<form id="media-search-form" action="media-library-assign-image.php" method="get">
		<input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Search...">
		<input type="submit" value="Search">
	</form>
	<div style="display:flex;flex-wrap:wrap;gap:10px;">
		<?php while ($media = $result->fetch_assoc()): ?>
			<div style="width:120px;text-align:center;">
				<img src="<?= $media['file_url_thumbnail'] ?>" width="100" style="cursor:pointer;border:1px solid #ccc;" 
						 onclick="selectMediaLibraryImage('<?= $media['key_media'] ?>','<?= $media['file_url_thumbnail'] ?>')">
				<div style="font-size:12px;"><?= htmlspecialchars($media['alt_text']) ?></div>
			</div>
		<?php endwhile; ?>
	</div>
	<div id="pager">
		<?php if ($page > 1): ?>
		<a href="media-library-assign-image.php?q=<?= urlencode($q) ?>&page=<?= $page - 1 ?>" class="media-modal-link" >⬅ Prev</a>
		<?php endif; ?>
		Page <?= $page ?> of <?= $total_pages ?>
		<?php if ($page < $total_pages): ?>
		<a href="media-library-assign-image.php?q=<?= urlencode($q) ?>&page=<?= $page + 1 ?>" class="media-modal-link" >Next ➡</a>
		<?php endif; ?>
	</div>
</div>
