<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>



<?php startLayout("Categories List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Category</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search categories..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<select name="type" onchange="this.form.submit()">
		<option value="">All Types</option>
		<option value="article">Article</option>
		<option value="book">Book</option>
		<option value="photo_gallery">Photo Gallery</option>
		<option value="video_gallery">Video Gallery</option>
		<option value="global">Global</option>
	</select>
	<input type="submit" value="Search">
</form>


<table>
  <thead>
    <tr>
      <th><?= sortLink('Name', 'name', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Description</th>
      <th><?= sortLink('URL', 'url', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
	  <th><?= sortLink('Type', 'category_type', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
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
	$allowedSorts = ['name', 'url', 'status', 'category_type'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';


	$sql = "SELECT * FROM categories";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(name, description) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}

	$type = $_GET['type'] ?? '';
	if ($type !== '') {
	  $type = $conn->real_escape_string($type);
	  $sql .= ($q === '' ? " WHERE " : " AND ") . "category_type = '$type'";
	}

	$sql .= " ORDER BY $sort $dir";
	
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['description']}</td>
        <td>{$row['url']}</td>
		<td>{$row['category_type']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_categories']}, \"get_category.php\", [\"name\",\"description\",\"url\",\"sort\",\"status\"]); return false;'>Edit</a> |
          <a href='delete.php?id={$row['key_categories']}' onclick='return confirm(\"Delete this category?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal Form -->
<div id="modal" class="modal">
	<h3 id="modal-title">Add Category</h3>
	<form id="modal-form" method="post">
	  <input type="hidden" name="key_categories" id="key_categories">

	  <input type="text" name="name" id="name" 
			 onchange="setCleanURL(this.value)" 
			 placeholder="Name" 
			 required maxlength="200"><br>

	  <textarea name="description" id="description" 
				placeholder="Description" 
				maxlength="1000"></textarea><br>

	  <select name="category_type" id="category_type" required>
		<option value="">--Select Type--</option>
		<option value="article">Article</option>
		<option value="book">Book</option>
		<option value="photo_gallery">Photo Gallery</option>
		<option value="video_gallery">Video Gallery</option>
		<option value="global">Global</option>
	  </select><br>

	  <input type="text" name="url" id="url" 
			 placeholder="Slug" 
			 maxlength="200" 
			 pattern="^[a-z0-9\-]+$" 
			 title="Lowercase letters, numbers, and hyphens only"><br>

	  <input type="number" name="sort" id="sort" 
			 placeholder="Sort Order" 
			 value="0" min="0" max="32767"><br>

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
