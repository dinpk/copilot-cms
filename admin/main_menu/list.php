<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php');
?>

<?php
$menuItems = [];
$sql = 'SELECT * FROM main_menu ORDER BY sort ASC';
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

<?php startLayout('Main Menu'); ?>

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
			$indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $depth);
			echo "<tr>
			<td>{$indent}{$item['title']}</td>
			<td>{$item['url_link']}</td>
			<td>{$item['sort']}</td>
			<td>{$item['status']}</td>
			<td class='record-action-links'>
			<a href='#' onclick='editItem({$item['key_main_menu']}, \"get_menu.php\", [\"title\",\"url_link\",\"sort\",\"status\",\"parent_id\"])'>Edit</a> 
			<a href='delete.php?id={$item['key_main_menu']}' onclick='return confirm(\"Delete this menu item?\")' style='display:none'>Delete</a>
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

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Menu Item</h3>
	<form id="modal-form" method="post">
		<input type="hidden" name="key_main_menu" id="key_main_menu">
		<input type="text" name="title" id="title" required maxlength="200"> <label>Title</label><br>
		<input type="text" name="url_link" id="url_link" pattern="^[a-z0-9\-\/]+$" maxlength="200"> <label>URL Link</label><br>
		<input type="number" name="sort" id="sort" value="0" min="0" max="2000"> <label>Sort</label><br>
		<input type="checkbox" name="status" id="status" value="on" checked> <label>Active</label><br>
		<select name="parent_id" id="parent_id">
			<option value="0">Top Level</option>
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