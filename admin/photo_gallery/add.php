<?php
include '../db.php';
include '../users/auth.php';
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'photo_gallery')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$availableForBlocks = isset($_POST['available_for_blocks']) ? 'on' : 'off';
	$status = isset($_POST['status']) ? 'on' : 'off';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	photo_gallery (title, url, image_url, description, navigation_type, css, available_for_blocks, status, created_by, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssssssii',
	$_POST['title'],
	$_POST['url'],
	$_POST['image_url'],
	$_POST['description'],
	$_POST['navigation_type'],
	$_POST['css'],
	$availableForBlocks,
	$status,
	$createdBy,
	$_POST['key_media_banner']
	);
	$stmt->execute();
	$newRecordId = $conn->insert_id;
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO photo_categories (key_photo_gallery, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $newRecordId, $catId);
			$stmtCat->execute();
		}
	}
}
?>