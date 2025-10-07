<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
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
      <th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	
	// sort
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'status'];
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
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_pages']}, \"get_page.php\", [\"title\",\"page_content\",\"url\",\"banner_image_url\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_pages']}' onclick='return confirm(\"Delete this page?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal Form -->
<div id="modal" class="modal">
	<h3 id="modal-title">Add Page</h3>
	<form id="modal-form" method="post">
	  <input type="hidden" name="key_pages" id="key_pages">

	  <input type="text" name="title" id="title" 
			 onchange="setCleanURL(this.value)" 
			 placeholder="Title" 
			 required maxlength="200"><br>

	  <textarea name="page_content" id="page_content" 
				placeholder="Content"></textarea><br>

	  <input type="text" name="url" id="url" 
			 placeholder="Slug" 
			 maxlength="200" 
			 pattern="^[a-z0-9\-]+$" 
			 title="Lowercase letters, numbers, and hyphens only"><br>

	  <input type="text" name="banner_image_url" id="banner_image_url" 
			 placeholder="Banner Image URL" 
			 maxlength="200"><br>

	  <label>
		<input type="checkbox" name="status" id="status" 
			   value="on" checked>
		Active
	  </label><br>

	  <input type="submit" value="Save">
	  <button type="button" onclick="closeModal()">Cancel</button>
	</form>

</div>


<?php endLayout(); ?>
