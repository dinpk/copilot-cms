<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("Content Type List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Content Type</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search content types..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Name', 'name', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Description</th>
			<th><?= sortLink('URL', 'url', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Type', 'name', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['name', 'url', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM content_types";
	if ($q !== '') {
		$sql .= " WHERE MATCH(name, description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	  echo "<tr>
			<td>{$row['name']}</td>
			<td>{$row['description']}</td>
			<td>{$row['url']}</td>
			<td>{$row['status']}</td>
			<td class='record-action-links'>
				<a href='#' onclick='editItem({$row['key_content_types']}, \"get_content_type.php\", [\"name\",\"description\",\"url\",\"banner_image_url\",\"sort\",\"key_media_banner\",\"status\"]); return false;'>Edit</a> 
				<a href='delete.php?id={$row['key_content_types']}' onclick='return confirm(\"Delete this content type?\")' >Delete</a>
			</td>
	  </tr>";
	}
	?>
	</tbody>
</table>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Content Type</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_content_types" id="key_content_types">
		<input type="text" name="name" id="name" onchange="setCleanURL(this.value)" required maxlength="200"> <label>Name</label><br>
		<input type="text" name="url" id="url" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, hyphens, forward slashes"> <label>Slug</label><br>
		<textarea name="description" id="description" placeholder="Description" title="Description" maxlength="1000"></textarea><br>
		<input type="url" name="banner_image_url" id="banner_image_url" placeholder="Full Banner Image URL"> <label>URL</label><br><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="galleryImage_openMediaModal(document.querySelector('#key_content_types').value)">Select Banner Image from Media Library</button><br>
		<input type="number" name="sort" id="sort" value="0" min="0" max="2000"> <label>Sort</label><br>
		<input type="checkbox" name="status" id="status" value="on" checked> <label>Active</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<div id="media-library-modal" class="modal modal-90"></div>

<?php endLayout(); ?>
