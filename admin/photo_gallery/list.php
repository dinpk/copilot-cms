<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include('../layout.php'); 
?>

<?php startLayout("Photo Gallery"); ?>

<p><a href="#" onclick="openModal()">➕ Add Photo Gallery</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search photos..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th>Image</th>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Created / Updated</th>
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
	$allowedSorts = ['title', 'is_active'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM photo_gallery";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(title,description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$keyPhotoGallery = $row["key_photo_gallery"];
		$createdUpdated = $conn->query("SELECT p.key_photo_gallery, u1.username AS creator, u2.username AS updater 
			FROM photo_gallery p 
			LEFT JOIN users u1 ON p.created_by = u1.key_user
			LEFT JOIN users u2 ON p.updated_by = u2.key_user 
			WHERE key_photo_gallery = $keyPhotoGallery")->fetch_assoc();		
	  echo "<tr>
		<td><img src='{$row['image_url']}' width='120'></td>
		<td>{$row['title']}</td>
		<td>{$createdUpdated['creator']} / {$createdUpdated['updater']}</td>
		<td>{$row['is_active']}</td>
		<td class='record-action-links'>
		  <a href='#' onclick='editItem({$row['key_photo_gallery']}, \"get_photo_gallery.php\", [\"title\",\"url\",\"image_url\",\"description\",\"navigation_type\",\"css\",\"available_for_blocks\",\"is_active\"])'>Edit</a> 
		  <a href='photo_gallery_delete.php?id={$row['key_photo_gallery']}' onclick='return confirm(\"Delete this photo?\")'>Delete</a> 
		  <a href='photo_gallery_images_list.php?gallery_id={$row['key_photo_gallery']}' target='_blank'>Assign Images</a>

		</td>
	  </tr>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM photo_gallery";
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
	<h3 id="modal-title">Add Photo Gallery</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_photo_gallery" id="key_photo_gallery">
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" required maxlength="255"> <label>Title</label><br>
		<input type="text" name="url" id="url" required maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, and hyphens only"> <label>Slug</label><br>
		<input type="text" name="image_url" id="image_url" maxlength="2000"> <label>Image URL</label><br>
		<br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="openMediaModal()">Select Banner Image from Media Library</button><br><br>
		<textarea name="description" id="description" placeholder="Description"></textarea><br>
		<select name="navigation_type" id="navigation_type">
			<option value="arrows">Arrows</option>
			<option value="slideshow">Slideshow</option>
		</select> <label>Navigation type</label>
		<br>
		<label><input type="checkbox" name="available_for_blocks" id="available_for_blocks"> Available for Blocks</label><br>
		<input type="text" name="css" id="css" maxlength="500"> <label>CSS</label><br>
		<label><input type="checkbox" name="is_active" id="is_active" checked> Active</label><br>
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

<div id="media-modal" class="modal">
	<a href="#" onclick="closeMediaModal();" class="close-icon">✖</a>
	<h3>Select Banner Image</h3>
	<div id="media-grid">
		<?php
	$mediaRes = $conn->query("SELECT key_media, file_url, alt_text FROM media_library WHERE file_type='images' ORDER BY entry_date_time DESC");
	while ($media = $mediaRes->fetch_assoc()) {
	  echo "<div class='media-thumb' onclick='selectMedia({$media['key_media']}, \"{$media['file_url']}\", \"image_url\")'>
			  <img src='{$media['file_url']}' width='100'><br>
			  <small>" . htmlspecialchars($media['alt_text']) . "</small>
			</div>";
	}
	?>
	</div>
</div>

<?php endLayout(); ?>