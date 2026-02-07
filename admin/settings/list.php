<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("Settings List"); ?>

<p><a href="#" onclick="openModal()">➕ Add New Setting</a> &nbsp;  📁 <a href="settings_misc.php">Misc Settings</a></p>

<?php
$groupOptions = [];
$groupResult = $conn->query("SELECT DISTINCT setting_group FROM settings_key_value ORDER BY setting_group ASC");
while ($g = $groupResult->fetch_assoc()) {
	$groupOptions[] = $g['setting_group'];
}
?>

<form method="get">
    <input type="text" name="q" placeholder="Search settings..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    
    <select name="group" onchange="this.form.submit()">
        <option value="">All Groups</option>
        <?php foreach ($groupOptions as $group): ?>
            <option value="<?= htmlspecialchars($group) ?>" <?= ($_GET['group'] ?? '') === $group ? 'selected' : '' ?>>
                <?= htmlspecialchars($group) ?>
            </option>
        <?php endforeach; ?>
    </select>
    
</form>

<table>
	<thead>
		<tr>
			<th><?= sortLink('Key', 'setting_key', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Value</th>
			<th><?= sortLink('Group', 'setting_group', $_GET['sort'] ?? '', $_GET['dir'] ?? '') ?></th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$q = $_GET['q'] ?? '';
	$q = $conn->real_escape_string($q);
	$sort = $_GET['sort'] ?? 'entry_date_time';
	$dir = $_GET['dir'] ?? 'desc';
	$allowedSorts = ['setting_key', 'setting_group'];
	$allowedDirs = ['asc', 'desc'];
	if (!in_array($sort, $allowedSorts)) $sort = 'entry_date_time';
	if (!in_array($dir, $allowedDirs)) $dir = 'desc';
	$group = $_GET['group'] ?? '';
	$group = $conn->real_escape_string($group);

	$sql = "SELECT * FROM settings_key_value ";
	if ($q !== '') {
		$sql .= " WHERE MATCH(setting_key, setting_value) AGAINST ('$q' IN NATURAL LANGUAGE MODE)";
	}
	$where_and = empty($q) ? "WHERE" : "AND";
	if ($group !== '') {
		$sql .= " $where_and setting_group = '$group'";
	}
	$sql .= " ORDER BY $sort $dir";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		echo "<tr>
			<td>{$row['setting_key']}</td>
			<td>{$row['setting_value']}</td>
			<td>{$row['setting_group']}</td>
			<td class='record-action-links'>
				<a href='#' onclick='editItem({$row['key_settings']}, \"get_setting.php\", [\"setting_key\",\"setting_value\",\"setting_group\"])'>Edit</a>
				<a href='delete.php?id={$row['key_settings']}' onclick='return confirm(\"Delete this setting?\")'>Delete</a>
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
		<select name="setting_group" id="setting_group">
			<option value="php_template">PHP Template</option>
			<option value="css_template">CSS Template</option>
			<option value="css_fonts">CSS Fonts</option>
			<option value="css_colors">CSS Colors</option>
			<option value="media_library">Media Library</option>
			<option value="general">General</option>
			<option value="cache">Cache</option>
		</select><br>

		<input type="submit" value="Save">
	</form>
</div>


<?php endLayout(); ?>