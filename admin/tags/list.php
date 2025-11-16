<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("Tags List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Tag</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search tags..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Name', 'name', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Description</th>
			<th><?= sortLink('URL', 'url', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Active', 'is_active', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['name', 'url', 'is_active'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM tags";
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
			<td>{$row['is_active']}</td>
			<td class='record-action-links'>
				<a href='#' onclick='editItem({$row['key_tags']}, \"get_tag.php\", [\"name\",\"description\",\"url\",\"banner_image_url\",\"sort\",\"key_media_banner\",\"is_active\"]); return false;'>Edit</a> 
				<a href='delete.php?id={$row['key_tags']}' onclick='return confirm(\"Delete this tag?\")' >Delete</a>
			</td>
	  </tr>";
	}
	?>
	</tbody>
</table>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Tag</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_tags" id="key_tags">
		<input type="text" name="name" id="name" onchange="setCleanURL(this.value)" required maxlength="200"> <label>Name</label><br>
		<input type="text" name="url" id="url" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, hyphens, forward slashes"> <label>Slug</label><br>
		<textarea name="description" id="description" placeholder="Description" title="Description" maxlength="1000"></textarea><br>
		<input type="url" name="banner_image_url" id="banner_image_url" placeholder="Full Banner Image URL"> <label>URL</label><br><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="galleryImage_openMediaModal(document.querySelector('#key_tags').value)">Select Banner Image from Media Library</button><br>
		<input type="number" name="sort" id="sort" value="0" min="0" max="2000"> <label>Sort</label><br>
		<input type="checkbox" name="is_active" id="is_active" checked> <label>Active</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<div id="media-library-modal" class="modal modal-90"></div>

<?php endLayout(); ?>
