<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$isPermanent = isset($_POST['is_permanent']) ? 1 : 0;
	$stmt = $conn->prepare('
	INSERT INTO 
	settings (setting_key, setting_value, setting_group, is_permanent) 
	VALUES (?, ?, ?, ?)
	');
	$stmt->bind_param('sssi',
	$_POST['setting_key'],
	$_POST['setting_value'],
	$_POST['setting_group'],
	$isPermanent
	);
	$stmt->execute();
}


include('generate_settings_file.php');


?>