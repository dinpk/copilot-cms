<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>

<?php startLayout("Authors List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Author</a></p>

<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search authors..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th><?= sortLink('Name', 'name', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Email', 'email', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('City', 'city', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Country', 'country', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
	  <th>Created</th>
	  <th>Updated</th>
      <th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
	
	// pager
	$limit = 10;
	$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
	$offset = ($page - 1) * $limit;
	
	// sort
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['name', 'email', 'city', 'country', 'status', 'entry_date_time'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';

	// search
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	
    $sql = "SELECT * FROM authors";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(name,description,city,country,state) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}

	$sql .= " ORDER BY $sort $dir LIMIT $limit OFFSET $offset";


    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
		
	// Show created by updated by
	$keyAuthors = $row["key_authors"];
	$createdUpdated = $conn->query("SELECT a.key_authors, u1.username AS creator, u2.username AS updater 
		FROM authors a 
		LEFT JOIN users u1 ON a.created_by = u1.key_user
		LEFT JOIN users u2 ON a.updated_by = u2.key_user 
		WHERE key_authors = $keyAuthors")->fetch_assoc();		
		
      echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['city']}</td>
        <td>{$row['country']}</td>
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_authors']}, \"get_author.php\", [\"name\",\"email\",\"phone\",\"website\",\"url\",\"social_url_media1\",\"social_url_media2\",\"social_url_media3\",\"city\",\"state\",\"country\",\"image_url\",\"description\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_authors']}' onclick='return confirm(\"Delete this author?\")'>Delete</a>
        </td>
      </tr>";
    }

	$countSql = "SELECT COUNT(*) AS total FROM authors";
	if ($q !== '') {
	  $countSql .= " WHERE MATCH(name,description,city,country,state) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$countResult = $conn->query($countSql);
	$totalArticles = $countResult->fetch_assoc()['total'];
	$totalPages = ceil($totalArticles / $limit);
	
    ?>
  </tbody>
</table>


<!-- Pager -->
<div style="margin-top:20px;">
	<?php if ($page > 1): ?>
	  <a href="?page=<?php echo $page - 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">⬅ Prev</a>
	<?php endif; ?>

	Page <?php echo $page; ?> of <?php echo $totalPages; ?>

	<?php if ($page < $totalPages): ?>
	  <a href="?page=<?php echo $page + 1; ?>&q=<?php echo urlencode($q); ?>&sort=<?php echo urlencode($sort); ?>&dir=<?php echo urlencode($dir); ?>">Next ➡</a>
	<?php endif; ?>
</div>

<!-- Modal Form -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Author</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_authors" id="key_authors">
    <input type="text" name="name" id="name" placeholder="Name" required><br>
    <input type="email" name="email" id="email" placeholder="Email"><br>
    <input type="text" name="phone" id="phone" placeholder="Phone"><br>
    <input type="text" name="website" id="website" placeholder="Website"><br>
    <input type="text" name="url" id="url" placeholder="URL"><br>
    <input type="text" name="social_url_media1" id="social_url_media1" placeholder="Social Media 1"><br>
    <input type="text" name="social_url_media2" id="social_url_media2" placeholder="Social Media 2"><br>
    <input type="text" name="social_url_media3" id="social_url_media3" placeholder="Social Media 3"><br>
    <input type="text" name="city" id="city" placeholder="City"><br>
    <input type="text" name="state" id="state" placeholder="State"><br>
    <input type="text" name="country" id="country" placeholder="Country"><br>
    <input type="text" name="image_url" id="image_url" placeholder="Image URL"><br>
    <textarea name="description" id="description" placeholder="Description"></textarea><br>
	<label>
	  <input type="checkbox" name="status" id="status" value="on" checked>
	  Active
	</label><br>

    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<?php endLayout(); ?>
