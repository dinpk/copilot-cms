<?php include '../db.php'; ?>
<?php include '../layout.php'; ?>
<?php startLayout("Main Menu"); ?>

<?php

$menuItems = [];
$sql = "SELECT * FROM main_menu ORDER BY sort ASC";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $menuItems[] = $row;
}


function buildMenuTree($items, $parentId = 0) {
  $branch = [];
  foreach ($items as $item) {
    if ($item['parent_id'] == $parentId) {
      $children = buildMenuTree($items, $item['key_main_menu']);
      if ($children) {
        $item['children'] = $children;
      }
      $branch[] = $item;
    }
  }
  return $branch;
}

$menuTree = buildMenuTree($menuItems);


?>



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
	function renderMenuRows($items, $depth = 0) {
	  foreach ($items as $item) {
		$indent = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $depth);
		echo "<tr>
		  <td>{$indent}{$item['title']}</td>
		  <td>{$item['url']}</td>
		  <td>{$item['sort']}</td>
		  <td>{$item['status']}</td>
		  <td>
			<a href='#' onclick='editItem({$item['key_main_menu']}, \"get_menu.php\", [\"title\",\"url\",\"sort\",\"status\",\"parent_id\"])'>Edit</a> |
			<a href='delete.php?id={$item['key_main_menu']}' onclick='return confirm(\"Delete this menu item?\")'>Delete</a>
		  </td>
		</tr>";
		if (!empty($item['children'])) {
		  renderMenuRows($item['children'], $depth + 1);
		}
	  }
	}

	renderMenuRows($menuTree);
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
	<select name="parent_id" id="parent_id">
	  <option value="0">-- Top Level --</option>
	  <?php
	  foreach ($menuItems as $item) {
		echo "<option value='{$item['key_main_menu']}'>{$item['title']}</option>";
	  }
	  ?>
	</select><br>
	
    <input type="submit" value="Save">
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="../assets/js/scripts.js"></script>

<?php endLayout(); ?>
