<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Categories List"); ?>

<a href="#" onclick="openModal()">➕ Add New Category</a>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th>URL</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM categories ORDER BY sort ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['description']}</td>
        <td>{$row['url']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_categories']}, \"get_category.php\", [\"name\",\"description\",\"url\",\"sort\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_categories']}' onclick='return confirm(\"Delete this category?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal Form -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Category</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_categories" id="key_categories">
    <input type="text" name="name" id="name" placeholder="Name" required><br>
    <textarea name="description" id="description" placeholder="Description"></textarea><br>
    <input type="text" name="url" id="url" placeholder="URL"><br>
    <input type="text" name="sort" id="sort" placeholder="Sort Order"><br>
    <input type="text" name="status" id="status" placeholder="Status"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
