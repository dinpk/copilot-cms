<?php
include '../db.php';
include '../users/auth.php';
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$is_active = isset($_POST['is_active']) ? 1 : 0;
	$stmt = $conn->prepare('
	UPDATE settings 
	SET setting_key = ?, setting_value = ?, setting_group = ?, setting_type = ?, is_active = ? 
	WHERE key_settings = ?
	');
	$stmt->bind_param('ssssii',
	$_POST['setting_key'],
	$_POST['setting_value'],
	$_POST['setting_group'],
	$_POST['setting_type'],
	$is_active,
	$id
	);
	$stmt->execute();
}
?>
