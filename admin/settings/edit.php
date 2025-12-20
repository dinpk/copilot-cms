<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$isPermanent = isset($_POST['is_permanent']) ? 1 : 0;
	$stmt = $conn->prepare('
	UPDATE settings 
	SET setting_key = ?, setting_value = ?, setting_group = ?, is_permanent = ? 
	WHERE key_settings = ?
	');
	$stmt->bind_param('sssii',
	$_POST['setting_key'],
	$_POST['setting_value'],
	$_POST['setting_group'],
	$isPermanent,
	$id
	);
	$stmt->execute();
}

include('generate_settings_file.php');

?>
