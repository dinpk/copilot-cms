<?php
include '../db.php';
include '../users/auth.php';
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'pages')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$stmt = $conn->prepare('
	INSERT INTO 
	pages (title, page_content, url, status, key_media_banner) 
	VALUES (?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssi',
		$_POST['title'],
		$_POST['page_content'],
		$_POST['url'],
		$status,
		$_POST['key_media_banner']
	  );
	$stmt->execute();
}
?>