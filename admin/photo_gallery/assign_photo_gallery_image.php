<?php
include '../db.php';
include '../users/auth.php';

$image_id = intval($_GET['image_id'] ?? 0);
if (!$image_id) die("Missing image ID");
$q = $_GET['q'] ?? '';

$image = $conn->query("SELECT key_photo_gallery FROM photo_gallery_images WHERE key_image = $image_id")->fetch_assoc();
$gallery_id = $image['key_photo_gallery'] ?? 0;

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
	<a href="#" onclick="document.getElementById('mediaPickerModal').style.display='none'" class="close-icon">✖</a>
	<h3>Select Image from Media Library</h3>
	<form id="media-search-form" action="assign_photo_gallery_image.php" method="get">
		<input type="hidden" name="image_id" value="<?= $image_id ?>">
		<input type="hidden" name="gallery_id" value="<?= $gallery_id ?>">
		<input type="text" name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Search...">
		<input type="submit" value="Search">
	</form>
	<div style="display:flex;flex-wrap:wrap;gap:10px;">
		<?php while ($media = $result->fetch_assoc()): ?>
		

			<div style="width:120px;text-align:center;">
				<img src="<?= $media['file_url_thumbnail'] ?>" width="100" style="cursor:pointer;border:1px solid #ccc;" 
						 onclick="galleryImage_assignMedia(<?= $image_id ?>, <?= $media['key_media'] ?>)">
				<div style="font-size:12px;"><?= htmlspecialchars($media['alt_text']) ?></div>
			</div>
		<?php endwhile; ?>
	</div>
	<div id="pager">
		<?php if ($page > 1): ?>
		<a href="assign_photo_gallery_image.php?image_id=<?= $image_id ?>&gallery_id=<?= $gallery_id ?>&q=<?= urlencode($q) ?>&page=<?= $page - 1 ?>" class="media-modal-link" data-image-id="<?= $image_id ?>">⬅ Prev</a>
		<?php endif; ?>
		Page <?= $page ?> of <?= $total_pages ?>
		<?php if ($page < $total_pages): ?>
		
		<a href="assign_photo_gallery_image.php?image_id=<?= $image_id ?>&gallery_id=<?= $gallery_id ?>&q=<?= urlencode($q) ?>&page=<?= $page + 1 ?>" class="media-modal-link" data-image-id="<?= $image_id ?>">Next ➡</a>
		<?php endif; ?>
	</div>
</div>
