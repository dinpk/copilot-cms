<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Pages List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Page</a></p>

<form method="get" style="margin-bottom:20px;">
  <input type="text" name="q" placeholder="Search pages..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>URL</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
    $sql = "SELECT * FROM pages";
	if ($q !== '') {
	  $sql .= " WHERE MATCH(title, page_content) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY entry_date_time DESC";
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
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Page</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_pages" id="key_pages">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <textarea name="page_content" id="page_content" placeholder="Content"></textarea><br>
    <input type="text" name="url" id="url" placeholder="URL"><br>
    <input type="text" name="banner_image_url" id="banner_image_url" placeholder="Banner Image URL"><br>
    <input type="text" name="status" id="status" placeholder="Status"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
