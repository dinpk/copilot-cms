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
	$visible_on = implode(',', $_POST['visible_on'] ?? []);
	$status = isset($_POST['status']) ? 'on' : 'off';
	$updatedBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	UPDATE blocks 
	SET block_name = ?, title = ?, block_content = ?, show_on_pages = ?, show_in_region = ?, sort = ?, module_file = ?, visible_on = ?, status = ?, updated_by = ?, key_media_banner = ?, key_photo_gallery = ? 
	WHERE key_blocks = ?
	');
	$stmt->bind_param('sssssisssiiii',
	$_POST['block_name'],
	$_POST['title'],
	$_POST['block_content'],
	$_POST['show_on_pages'],
	$_POST['show_in_region'],
	$_POST['sort'],
	$_POST['module_file'],
	$visible_on,
	$status,
	$updatedBy,
	$_POST['key_media_banner'],
	$_POST['key_photo_gallery'],
	$id
	);
	$stmt->execute();
	
	
}
?>