<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Blocks List"); ?>

<a href="#" onclick="openModal()">➕ Add New Block</a>

<table>
  <thead>
    <tr>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Region', 'show_in_region', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Pages', 'show_on_pages', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Status', 'status', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
 
  
    <?php
	

	// sort
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['title', 'region', 'pages', 'status'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';

	
    $sql = "SELECT * FROM blocks ORDER BY $sort $dir";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['show_in_region']}</td>
        <td>{$row['show_on_pages']}</td>
        <td>{$row['status']}</td>
        <td>
          <a href='#' onclick='editItem({$row['key_blocks']}, \"get_block.php\", [\"title\",\"block_content\",\"show_on_pages\",\"show_in_region\",\"sort\",\"module_file\",\"status\"])'>Edit</a> |
          <a href='delete.php?id={$row['key_blocks']}' onclick='return confirm(\"Delete this block?\")'>Delete</a>
        </td>
      </tr>";
    }
    ?>
  </tbody>
</table>

<!-- Modal Form -->
<div id="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
  <h3 id="modal-title">Add Block</h3>
  <form id="modal-form" method="post" action="add.php">
    <input type="hidden" name="key_blocks" id="key_blocks">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <textarea name="block_content" id="block_content" placeholder="Content"></textarea><br>
    <input type="text" name="show_on_pages" id="show_on_pages" placeholder="Show on Pages"><br>
    <input type="text" name="show_in_region" id="show_in_region" placeholder="Region"><br>
    <input type="text" name="sort" id="sort" placeholder="Sort Order"><br>
    <input type="text" name="module_file" id="module_file" placeholder="Module File"><br>
    <input type="text" name="status" id="status" placeholder="Status"><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
