<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'tags')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$stmt = $conn->prepare('
	INSERT INTO 
	tags (name, description, url, banner_image_url, sort, is_active, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssiii',
	$_POST['name'],
	$_POST['description'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['sort'],
	$isActive,
	$_POST['key_media_banner']
	);
	$stmt->execute();
}
?>