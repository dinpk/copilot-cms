<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>

<?php startLayout("Media Library"); ?>

<p><a href="#" onclick="openModal()">➕ Upload New Media</a></p>

<form method="get">
  <input type="text" name="q" placeholder="Search tags..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
  <input type="submit" value="Search">
</form>

<table>
  <thead>
    <tr>
      <th>Preview</th>
      <th>Type</th>
      <th>Tags</th>
      <th>Alt Text</th>
      <th>Uploaded By</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $q = $conn->real_escape_string($_GET['q'] ?? '');
    $sql = "SELECT m.*, u.username FROM media_library m LEFT JOIN users u ON m.uploaded_by = u.key_user";
    if ($q !== '') {
      $sql .= " WHERE tags LIKE '%$q%'";
    }
    $sql .= " ORDER BY entry_date_time DESC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td><img src='{$row['file_url']}' width='100'></td>
        <td>{$row['file_type']}</td>
        <td>{$row['tags']}</td>
        <td>{$row['alt_text']}</td>
        <td>{$row['username']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_media']}, \"get_media.php\", [\"file_url\",\"file_type\",\"alt_text\",\"tags\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_media']}' onclick='return confirm(\"Delete this media item?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal Form -->
<div id="modal" class="modal">
  <h3 id="modal-title">Upload Media</h3>
  <form id="modal-form" method="post" enctype="multipart/form-data" action="add.php">
    <input type="hidden" name="key_media" id="key_media">

    <input type="url" name="file_url" id="file_url" placeholder="Media URL" required maxlength="2000"><br>
	<br>

    <select name="file_type" id="file_type" required>
      <option value="">--Select Type--</option>
      <option value="image">Image</option>
      <option value="video">Video</option>
      <option value="pdf">PDF</option>
      <option value="other">Other</option>
    </select><br>

	<br>
	
    <input type="text" name="alt_text" id="alt_text" placeholder="Alt Text" maxlength="500"><br>
    <input type="text" name="tags" id="tags" placeholder="Tags (comma-separated)" maxlength="500"><br>

    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<?php endLayout(); ?>
