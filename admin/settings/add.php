<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$isActive = isset($_POST['is_active']) ? 1 : 0;
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
	$isActive
	);
	$stmt->execute();
}


include('generate_settings_file.php');


?>