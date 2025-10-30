<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'youtube_gallery')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	youtube_gallery (title, youtube_id, thumbnail_url, url, description, status, created_by, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssssii',
	$_POST['title'],
	$_POST['youtube_id'],
	$_POST['thumbnail_url'],
	$_POST['url'],
	$_POST['description'],
	$status,
	$createdBy,
	$_POST['key_media_banner']
	);
	$stmt->execute();
	$newRecordId = $conn->insert_id;
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO youtube_categories (key_youtube_gallery, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $newRecordId, $catId);
			$stmtCat->execute();
		}
	}
}
?>
