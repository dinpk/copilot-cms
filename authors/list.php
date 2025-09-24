<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Authors List"); ?>

<a href="#" onclick="openModal()">➕ Add New Author</a>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>City</th>
      <th>Country</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM authors ORDER BY entry_date_time DESC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['city']}</td>
        <td>{$row['country']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_authors']}, \"get_author.php\", [\"name\",\"email\",\"phone\",\"website\",\"url\",\"social_url_media1\",\"social_url_media2\",\"social_url_media3\",\"city\",\"state\",\"country\",\"image_url\",\"description\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_authors']}' onclick='return confirm(\"Delete this author?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

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
    <input type="text" name="status" id="status" placeholder="Status"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
