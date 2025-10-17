<?php
include '../db.php';
include '../users/auth.php';
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
?>