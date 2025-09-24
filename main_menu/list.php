<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Main Menu"); ?>

<a href="#" onclick="openModal()">➕ Add Menu Item</a>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>URL</th>
      <th>Sort</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM main_menu ORDER BY sort ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['url']}</td>
        <td>{$row['sort']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_main_menu']}, \"get_menu.php\", [\"title\",\"url\",\"sort\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_main_menu']}' onclick='return confirm(\"Delete this menu item?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal Form -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Menu Item</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_main_menu" id="key_main_menu">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <input type="text" name="url" id="url" placeholder="URL"><br>
    <input type="text" name="sort" id="sort" placeholder="Sort Order"><br>
    <input type="text" name="status" id="status" placeholder="Status"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
