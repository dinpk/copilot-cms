<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("Home Page Sections"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Section</a></p>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Section Type</th>
			<th><?= sortLink('Sort', 'sort', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th><?= sortLink('Active', 'is_active', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sort = $_GET['sort'] ?? 'sort';
	$dir = $_GET['dir'] ?? 'asc';
	$allowedSorts = ['title', 'sort', 'is_active'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM home_page_sections";
	if ($q !== '') {
		$sql .= " WHERE MATCH(title, content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	  echo "<tr>
			<td>{$row['title']}</td>
			<td>{$row['section_type']}</td>
			<td>{$row['sort']}</td>
			<td>{$row['is_active']}</td>
			<td class='record-action-links'>
			  <a href='#' onclick='editItem({$row['key_home_page_sections']}, \"get_home_page_section.php\", [\"title\",\"content\",\"image_url\",\"target_url\",\"section_type\",\"sort\",\"key_media_banner\",\"is_active\"])'>Edit</a> 
			  <a href='delete.php?id={$row['key_home_page_sections']}' onclick='return confirm(\"Delete this page?\")'>Delete</a>
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
		<input type="hidden" name="key_home_page_sections" id="key_home_page_sections">

		<select name="section_type" id="section_type">
			<?php
				$sectionTypes = [
					"hero"   		=> "Hero",
					"articles" 		=> "Articles",
					"books" 		=> "Books",
					"authors"       => "Authors",
					"content_types" => "Content Types",
					"categories"    => "Categories",
					"tags"    		=> "Tags",
					"galleries"     => "Galleries",
					"videos"        => "Videos",
					"contact"       => "Contact",
					"footer"       	=> "Footer",
					"custom"   		=> "Custom"
				];
			?>
			<?php foreach ($sectionTypes as $value => $label): ?>
				<option value="<?= $value ?>" <?= ($section_type ?? '') === $value ? 'selected' : '' ?>>
					<?= $label ?>
				</option>
			<?php endforeach; ?>
		</select> Section type<br>

		<input type="text" name="title" id="title" onchange="setCleanURL(this.value)" maxlength="200"> <label>Title</label><br>
		<textarea name="content" id="content" placeholder="Content" title="Content"></textarea><br>

		<input type="text" name="image_url" id="image_url" maxlength="2000"> <label>Image URL</label><br>
		<input type="hidden" name="key_media_banner" id="key_media_banner">
		<div id="media-preview"></div>
		<button type="button" onclick="galleryImage_openMediaModal(document.querySelector('#key_home_page_sections').value)">Select Banner Image from Media Library</button><br>

		<input type="url" name="target_url" id="target_url" maxlength="2000"> <label>Target URL</label><br>


		<input type="number" name="sort" id="sort" value="0" min="-100" max="2000"> <label>Sort</label><br>
		<input type="checkbox" name="is_active" id="is_active" checked> <label>Active</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<div id="media-library-modal" class="modal modal-90"></div>

<?php endLayout(); ?>