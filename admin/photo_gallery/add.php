<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'photo_gallery')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$availableForBlocks = isset($_POST['available_for_blocks']) ? '1' : '0';
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	photo_gallery (title, url, image_url, description, navigation_type, css, available_for_blocks, is_active, created_by, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssssiiii',
	$_POST['title'],
	$_POST['url'],
	$_POST['image_url'],
	$_POST['description'],
	$_POST['navigation_type'],
	$_POST['css'],
	$availableForBlocks,
	$isActive,
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