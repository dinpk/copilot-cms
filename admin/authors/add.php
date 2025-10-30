<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo '⚠ You do not have access to add a record';
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'authors')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	authors (name, email, phone, website, url, banner_image_url, social_url_media1, social_url_media2, social_url_media3, city, state, country, description, status, created_by, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssssssssssssii',
	$_POST['name'],
	$_POST['email'],
	$_POST['phone'],
	$_POST['website'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['social_url_media1'],
	$_POST['social_url_media2'],
	$_POST['social_url_media3'],
	$_POST['city'],
	$_POST['state'],
	$_POST['country'],
	$_POST['description'],
	$status,
	$createdBy,
	$_POST['key_media_banner']
  );
	$stmt->execute();
}
?>