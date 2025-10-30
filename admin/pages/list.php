<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("Pages List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Page</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search pages..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>URL</th>
			<th><?= sortLink('Sort', 'sort', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sort = $_GET['sort'] ?? 'sort';
	$dir = $_GET['dir'] ?? 'asc';
	$allowedSorts = ['title', 'sort', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM pages";
	if ($q !== '') {
		$sql .= " WHERE MATCH(title, page_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	  echo "<tr>
			<td>{$row['title']}</td>
			<td>{$row['url']}</td>
			<td>{$row['sort']}</td>
			<td>{$row['status']}</td>
			<td class='record-action-links'>
			  <a href='#' onclick='editItem({$row['key_pages']}, \"get_page.php\", [\"title\",\"page_content\",\"url\",\"banner_image_url\",\"sort\",\"key_media_banner\",\"status\"])'>Edit</a> 
			  <a href='delete.php?id={$row['key_pages']}' onclick='return confirm(\"Delete this page?\")'>Delete</a>
			</td>
		</tr>";
	}
	?>
	</tbody>
</table>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Page</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_pages" id="key_pages">
		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" required maxlength="200"> <label>Title</label><br>
		<textarea name="page_content" id="page_content" placeholder="Content" title="Content"></textarea><br>
		<input type="text" name="url" id="url" maxlength="200" pattern="^[a-z0-9\-\/]+$" title="Lowercase letters, numbers, hyphens, forward slashes"> <label>Slug</label><br>
		<input type="url" name="banner_image_url" id="banner_image_url" placeholder="Full Banner Image URL"> <label>URL</label><br><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="galleryImage_openMediaModal(document.querySelector('#key_pages').value)">Select Banner Image from Media Library</button><br>
		<input type="number" name="sort" id="sort" value="0" min="0" max="2000"> <label>Sort</label><br>
		<input type="checkbox" name="status" id="status" value="on" checked> <label>Active</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<div id="media-library-modal" class="modal modal-90"></div>

<?php endLayout(); ?>