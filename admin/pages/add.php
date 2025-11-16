<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'pages')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$stmt = $conn->prepare('
	INSERT INTO 
	pages (title, page_content, url, banner_image_url, is_active, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssii',
		$_POST['title'],
		$_POST['page_content'],
		$_POST['url'],
		$_POST['banner_image_url'],
		$isActive,
		$_POST['key_media_banner']
	  );
	$stmt->execute();
}
?>