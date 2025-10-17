<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>

<?php startLayout("Settings List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Setting</a></p>

<form method="get">
	<input type="text" name="q" placeholder="Search settings..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
	<input type="submit" value="Search">
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Key', 'setting_key', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Value</th>
			<th><?= sortLink('Group', 'setting_group', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Type</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['setting_key', 'setting_group', 'setting_type'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$sql = "SELECT * FROM settings WHERE is_active = 1";
	if ($q !== '') {
	  $sql .= " AND MATCH(setting_key, setting_value) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$sql .= " ORDER BY $sort $dir";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
	  echo "<tr>
		<td>{$row['setting_key']}</td>
		<td>{$row['setting_value']}</td>
		<td>{$row['setting_group']}</td>
		<td>{$row['setting_type']}</td>
		<td>" . ($row['is_active'] ? '✅' : '❌') . "</td>
		<td class='record-action-links'>
			<a href='#' onclick='editItem({$row['key_settings']}, \"get_setting.php\", [\"setting_key\",\"setting_value\",\"setting_group\",\"setting_type\",\"is_active\"])'>Edit</a> 
			<a href='delete.php?id={$row['key_settings']}' onclick='return confirm(\"Delete this setting?\")' style='display:none'>Delete</a>
		</td>
	  </tr>";
	}
	?>
	</tbody>
</table>

<div id="modal" class="modal">
	<a href="#" onclick="closeModal();" class="close-icon">✖</a>
	<h3 id="modal-title">Add Setting</h3>
	<form id="modal-form" method="post" action="add.php">
		<input type="hidden" name="key_settings" id="key_settings">
		<label>Key</label><br>
		<input type="text" name="setting_key" id="setting_key" required maxlength="100"><br>
		<label>Value</label><br>
		<div id="value-wrapper">
			<textarea name="setting_value" id="setting_value" required></textarea>
		</div>
		<label>Group</label><br>
		<input type="text" name="setting_group" id="setting_group" title="homepage, ui, article_view etc." maxlength="50"><br>
		<label>Type</label><br>
		<select name="setting_type" id="setting_type">
			<option value="text">Text</option>
			<option value="number">Number</option>
			<option value="boolean">Boolean</option>
			<option value="url">URL</option>
			<option value="color">Color</option>
			<option value="json">JSON</option>
			<option value="dropdown">dropdown</option>
		</select><br>
		<label>
			<input type="checkbox" name="is_active" id="is_active" value="1" checked>
			Active
		</label><br>
		<input type="submit" value="Save">
	</form>
</div>

<?php
$folders = array_filter(glob('../../templates/*'), 'is_dir');
$templateOptions = array_map('basename', $folders);
$dropdownHTML = "<select name='setting_value' id='setting_value'>";
foreach ($templateOptions as $folder) {
	$dropdownHTML .= "<option value='$folder'>$folder</option>";
}
$dropdownHTML .= "</select>";
?>
<script>
	document.getElementById('setting_type').addEventListener('change', function() {
		const wrapper = document.getElementById('value-wrapper');
		const type = this.value;
		if (type === 'dropdown') {
			wrapper.innerHTML = <?= json_encode($dropdownHTML) ?> ;
		} else {
			wrapper.innerHTML = `<textarea name="setting_value" id="setting_value" required></textarea>`;
		}
	});
</script>

<?php endLayout(); ?>