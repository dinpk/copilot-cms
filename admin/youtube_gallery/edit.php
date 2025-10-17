<?php
include '../db.php';
include '../users/auth.php';
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	if (isUrlTaken($_POST['url'], 'youtube_gallery', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$updatedBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
		UPDATE youtube_gallery 
		SET title = ?, youtube_id = ?, thumbnail_url = ?, url = ?, description = ?, status = ?, updated_by = ?, key_media_banner = ? 
		WHERE key_youtube_gallery = ?
		');
	$stmt->bind_param('ssssssiii',
		$_POST['title'],
		$_POST['youtube_id'],
		$_POST['thumbnail_url'],
		$_POST['url'],
		$_POST['description'],
		$status,
		$updatedBy,
		$_POST['key_media_banner'],
		$id
	);
	$stmt->execute();
	$conn->query("DELETE FROM youtube_categories WHERE key_youtube_gallery = $id");
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO youtube_categories (key_youtube_gallery, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $id, $catId);
			$stmtCat->execute();
		}
	}
}
?>