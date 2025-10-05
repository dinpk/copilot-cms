<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Blocks List"); ?>

<a href="#" onclick="openModal()">➕ Add New Block</a>

<table>
  <thead>
    <tr>
      <th><?= sortLink('Title', 'title', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Region', 'show_in_region', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
      <th><?= sortLink('Pages', 'show_on_pages', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
	  <th>Created</th>
	  <th>Updated</th>
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
		
		// Show created by updated by
		$keyBlocks = $row["key_blocks"];
		$createdUpdated = $conn->query("SELECT b.key_blocks, u1.username AS creator, u2.username AS updater 
			FROM blocks b 
			LEFT JOIN users u1 ON b.created_by = u1.key_user
			LEFT JOIN users u2 ON b.updated_by = u2.key_user 
			WHERE key_blocks = $keyBlocks")->fetch_assoc();		

      echo "<tr>
        <td>{$row['title']}</td>
        <td>{$row['show_in_region']}</td>
        <td>{$row['show_on_pages']}</td>
		<td>{$createdUpdated['creator']}</td>
		<td>{$createdUpdated['updater']}</td>
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
<div id="modal" class="modal">
  <h3 id="modal-title">Add Block</h3>
  <form id="modal-form" method="post">
    <input type="hidden" name="key_blocks" id="key_blocks">
    <input type="text" name="title" id="title" placeholder="Title" required><br>
    <textarea name="block_content" id="block_content" placeholder="Content"></textarea><br>
    <input type="text" name="show_on_pages" id="show_on_pages" placeholder="Show on Pages"><br>
    <input type="text" name="show_in_region" id="show_in_region" placeholder="Region"><br>
    <input type="number" value="0" name="sort" id="sort" placeholder="Sort Order"><br>
    <input type="text" name="module_file" id="module_file" placeholder="Module File"><br>
	<label>
	  <input type="checkbox" name="status" id="status" value="on" checked>
	  Active
	</label><br>
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<?php endLayout(); ?>
