<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'users')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$stmt = $conn->prepare('
	INSERT INTO 
	users (name, username, password_hash, email, role, status, phone, address, city, state, country, description, url, banner_image_url, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
	$stmt->bind_param('ssssssssssssssi',
	$_POST['name'],
	$_POST['username'],
	$passwordHash,
	$_POST['email'],
	$_POST['role'],
	$status,
	$_POST['phone'],
	$_POST['address'],
	$_POST['city'],
	$_POST['state'],
	$_POST['country'],
	$_POST['description'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['key_media_banner']
	);
	$stmt->execute();
}
?>