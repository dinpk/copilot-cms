<?php
include '../db.php';
include '../users/auth.php';
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$visible_on = implode(',', $_POST['visible_on'] ?? []);
	$status = isset($_POST['status']) ? 'on' : 'off';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	blocks (block_name, title, block_content, show_on_pages, show_in_region, sort, module_file, visible_on, status, created_by, key_media_banner, key_photo_gallery) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('sssssisssiii',
	$_POST['block_name'],
	$_POST['title'],
	$_POST['block_content'],
	$_POST['show_on_pages'],
	$_POST['show_in_region'],
	$_POST['sort'],
	$_POST['module_file'],
	$visible_on,
	$status,
	$createdBy,
	$_POST['key_media_banner'],
	$_POST['key_photo_gallery']
	);
	$stmt->execute();
}
?>