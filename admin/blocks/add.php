<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$visible_on = implode(',', $_POST['visible_on'] ?? []);
	$isDynamic = isset($_POST['is_dynamic']) ? '1' : '0';
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	blocks (block_name, title, block_content, show_on_pages, show_in_region, sort, css, module_file, visible_on, number_of_records, is_dynamic, is_active, created_by, key_media_banner, key_photo_gallery) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('sssssisssiiiiii',
	$_POST['block_name'],
	$_POST['title'],
	$_POST['block_content'],
	$_POST['show_on_pages'],
	$_POST['show_in_region'],
	$_POST['sort'],
	$_POST['css'],
	$_POST['module_file'],
	$visible_on,
	$_POST['number_of_records'],
	$isDynamic,
	$isActive,
	$createdBy,
	$_POST['key_media_banner'],
	$_POST['key_photo_gallery']
	);
	$stmt->execute();
}
?>