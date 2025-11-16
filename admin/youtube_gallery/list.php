<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("YouTube Gallery"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Video</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search videos..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th>Thumbnail</th>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Created</th>
			<th>Updated</th>
			<th><?= sortLink('Active', 'is_active', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$limit = 10;
	$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
	$offset = ($page - 1) * $limit;
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['name', 'email', 'city', 'country', 'is_active', 'entry_date_time'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM youtube_gallery";
	if ($q !== '') {
		$sql .= " WHERE MATCH(title,description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$keyYoutubeGallery = $row["key_youtube_gallery"];
		$createdUpdated = $conn->query("SELECT p.key_youtube_gallery, u1.username AS creator, u2.username AS updater 
			FROM youtube_gallery p 
			LEFT JOIN users u1 ON p.created_by = u1.key_user
			LEFT JOIN users u2 ON p.updated_by = u2.key_user 
			WHERE key_youtube_gallery = $keyYoutubeGallery")->fetch_assoc();		
	  echo "<tr>
		<td><img src='{$row['thumbnail_url']}' width='120'></td>
		<td>{$row['title']}</td>
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
		<td>{$row['is_active']}</td>
		<td class='record-action-links'>
		  <a href='#' onclick='editItem({$row['key_youtube_gallery']}, \"get_video.php\", [\"title\",\"youtube_id\",\"thumbnail_url\",\"url\",\"description\",\"is_active\"])'>Edit</a> 
		  <a href='delete.php?id={$row['key_youtube_gallery']}' onclick='return confirm(\"Delete this video?\")' style='display:none'>Delete</a>
		</td>
	  </tr>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM youtube_gallery";
	if ($q !== '') {
		$countSql .= " WHERE MATCH(title,description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$countResult = $conn->query($countSql);
	$totalArticles = $countResult->fetch_assoc()['total'];
	$totalPages = ceil($totalArticles / $limit);
	?>
	</tbody>
</table>

<div id="pager">
	<?php if ($page > 1): ?>
	<a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">⬅ Prev</a>
	<?php endif; ?>
	Page <?php echo $page; ?> of <?php echo $totalPages; ?>
	<?php if ($page < $totalPages): ?>
	<a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">Next ➡</a>
	<?php endif; ?>
</div>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Video</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_youtube_gallery" id="key_youtube_gallery">
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" required maxlength="255"> <label>Title</label><br>
		<input type="text" name="youtube_id" id="youtube_id" required maxlength="20"> <label>Video ID</label><br>
		<input type="url" name="thumbnail_url" id="thumbnail_url" placeholder="Thumbnail URL" maxlength="2000"> <label>Thumbnail URL</label><br>
		<input type="text" name="url" id="url" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, hyphens"> <label>Slug</label><br>
		<textarea name="description" id="description" placeholder="Description"></textarea><br>
		<input type="checkbox" name="is_active" id="is_active" checked> <label>Active</label><br>
		<details id="select-categories">
			<summary>Categories</summary>
			<div>
			<?php
			$types = ['article', 'book', 'photo_gallery', 'video_gallery', 'global'];
			foreach ($types as $type) {
			  echo "<h4>" . ucfirst(str_replace('_', ' ', $type)) . "</h4>";
			  $catResult = $conn->query("SELECT key_categories, name FROM categories WHERE category_type = '$type' AND is_active = 1 ORDER BY sort");
			  while ($cat = $catResult->fetch_assoc()) {
				echo "<label><input type='checkbox' name='categories[]' value='{$cat['key_categories']}'> {$cat['name']}</label>";
			  }
			}
			?>
			</div>
		</details>
		<input type="submit" value="Save">
	</form>
</div>

<?php endLayout(); ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
	const youtubeIdField = document.getElementById("youtube_id");
	const thumbnailUrlField = document.getElementById("thumbnail_url");

	if (youtubeIdField && thumbnailUrlField) {
		youtubeIdField.addEventListener("input", function () {
			const videoId = youtubeIdField.value.trim();
			if (videoId) {
				const thumbnailUrl = `https://i.ytimg.com/vi/${videoId}/maxresdefault.jpg`;
				thumbnailUrlField.value = thumbnailUrl;
			} else {
				thumbnailUrlField.value = "";
			}
		});
	}
});

/*
maxresdefault.jpg 	— (highest resolution)
hqdefault.jpg 		— (high quality)
mqdefault.jpg 		— (medium quality)
default.jpg 		— (low quality)
*/

</script>
