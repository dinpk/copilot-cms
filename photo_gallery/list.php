<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Photo Gallery"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Photo</a></p>

<form method="get">
  <input type="text" name="q" placeholder="Search photos..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Image</th>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
	  <th>Created</th>
	  <th>Updated</th>
      <th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
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

	// sort
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'status'];
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
		
		// Show created by updated by
		$keyPhotoGallery = $row["key_photo_gallery"];
		$createdUpdated = $conn->query("SELECT p.key_photo_gallery, u1.username AS creator, u2.username AS updater 
			FROM photo_gallery p 
			LEFT JOIN users u1 ON p.created_by = u1.key_user
			LEFT JOIN users u2 ON p.updated_by = u2.key_user 
			WHERE key_photo_gallery = $keyPhotoGallery")->fetch_assoc();		

		
      echo "<tr>
        <td><img src='{$row['image_url']}' width='120'></td>
        <td>{$row['title']}</td>
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_photo_gallery']}, \"get_photo.php\", [\"title\",\"image_url\",\"description\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_photo_gallery']}' onclick='return confirm(\"Delete this photo?\")'>Delete</a>
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


<!-- Pager -->
<div id="pager">
	<?php if ($page > 1): ?>
	  <a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">⬅ Prev</a>
	<?php endif; ?>

	Page <?php echo $page; ?> of <?php echo $totalPages; ?>

	<?php if ($page < $totalPages): ?>
	  <a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">Next ➡</a>
	<?php endif; ?>
</div>


<!-- Modal Form -->
<div id="modal" class="modal">
  <h3 id="modal-title">Add Photo</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_photo_gallery" id="key_photo_gallery">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <input type="text" name="image_url" id="image_url" placeholder="Image URL" required><br>
    <textarea name="description" id="description" placeholder="Description"></textarea><br>
	<label>
	  <input type="checkbox" name="status" id="status" value="on" checked>
	  Active
	</label><br>
	
	
	<div id="select-categories">
	  <h3>Categories</h3>
		<?php
		$types = ['photo_gallery', 'book', 'article', 'video_gallery', 'global'];

		foreach ($types as $type) {
		  echo "<div style='color:margin:10px 0;'>";
		  echo "<div style='color:Navy;padding:10px 0 10px 0;'>" . ucfirst(str_replace('_', ' ', $type)) . "</div>";

		  $catResult = $conn->query("SELECT key_categories, name FROM categories WHERE category_type = '$type' AND status='on' ORDER BY sort");

		  while ($cat = $catResult->fetch_assoc()) {
			echo "<label style='display:block;'>
					<input type='checkbox' name='categories[]' value='{$cat['key_categories']}'> {$cat['name']}
				  </label>";
		  }

		  echo "</div>";
		}
		?>
	</div>
	
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<?php endLayout(); ?>
