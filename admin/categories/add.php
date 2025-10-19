<?php
include '../db.php';
include '../users/auth.php';
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'categories')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$stmt = $conn->prepare('
	INSERT INTO 
	categories (name, description, url, banner_image_url, sort, status, category_type, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssissi',
	$_POST['name'],
	$_POST['description'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['sort'],
	$status,
	$_POST['category_type'],
	$_POST['key_media_banner']
	);
	$stmt->execute();
}
?>