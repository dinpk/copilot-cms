<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


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
      <th>URL-Link</th>
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
		  <td>{$item['url_link']}</td>
		  <td>{$item['sort']}</td>
		  <td>{$item['status']}</td>
		  <td>
			<a href='#' onclick='editItem({$item['key_main_menu']}, \"get_menu.php\", [\"title\",\"url_link\",\"sort\",\"status\",\"parent_id\"])'>Edit</a> |
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
<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Menu Item</h3>
	<form id="modal-form" method="post">
	  <input type="hidden" name="key_main_menu" id="key_main_menu">

	  <input type="text" name="title" id="title" 
			 placeholder="Title" 
			 required maxlength="200"><br>

	  <input type="text" name="url_link" id="url_link" 
			 placeholder="URL-Link" 
			 pattern="^[a-z0-9\-\/]+$" 
			 maxlength="200"><br>

	  <input type="number" name="sort" id="sort" 
			 placeholder="Sort Order" 
			 value="0" min="0" max="32767"><br>

	  <label>
		<input type="checkbox" name="status" id="status" 
			   value="on" checked>
		Active
	  </label><br>

	  <select name="parent_id" id="parent_id">
		<option value="0">-- Top Level --</option>
		<?php
		foreach ($menuItems as $item) {
		  echo "<option value='{$item['key_main_menu']}'>{$item['title']}</option>";
		}
		?>
	  </select><br>

	  <input type="submit" value="Save">
	</form>

</div>


<?php endLayout(); ?>
