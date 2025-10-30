<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$is_active = isset($_POST['is_active']) ? 1 : 0;
	$stmt = $conn->prepare('
	INSERT INTO 
	settings (setting_key, setting_value, setting_group, setting_type, is_active) 
	VALUES (?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssi',
	$_POST['setting_key'],
	$_POST['setting_value'],
	$_POST['setting_group'],
	$_POST['setting_type'],
	$is_active
	);
	$stmt->execute();
}



$settingsArray = [];
$sql = "SELECT setting_key, setting_value FROM settings WHERE is_active = 1";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$settingsArray[$row['setting_key']] = $row['setting_value'];
}

foreach ($settingsArray as $key => $value) {
	$escapedValue = var_export($value, true);
	$lines[] = "\$settings['{$key}'] = {$escapedValue};";
}

$lines_text = implode("\n", $lines);
file_put_contents('../../templates/settings.php', "<?php\n\$settings = [];\n$lines_text");


?>