<?php
include '../db.php';
include '../users/auth.php';
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	if (isUrlTaken($_POST['url'], 'photo_gallery', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$availableForBlocks = isset($_POST['available_for_blocks']) ? 'on' : 'off';
	$status = isset($_POST['status']) ? 'on' : 'off';
	$updatedBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	UPDATE photo_gallery 
	SET title = ?, url = ?, image_url = ?, description = ?, navigation_type = ?, css = ?, available_for_blocks = ?, status = ?, updated_by = ?, key_media_banner = ? 
	WHERE key_photo_gallery = ?
	');
	$stmt->bind_param('ssssssssiii',
	$_POST['title'],
	$_POST['url'],
	$_POST['image_url'],
	$_POST['description'],
	$_POST['navigation_type'],
	$_POST['css'],
	$availableForBlocks,
	$status,
	$updatedBy,
	$_POST['key_media_banner'],
	$id
  );
	$stmt->execute();
	$conn->query("DELETE FROM photo_categories WHERE key_photo_gallery = $id");
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO photo_categories (key_photo_gallery, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $id, $catId);
			$stmtCat->execute();
		}
	}
}
?>