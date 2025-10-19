<?php
include '../db.php';
include '../users/auth.php';
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	if (isUrlTaken($_POST['url'], 'books', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$updatedBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	UPDATE books 
	SET title = ?, subtitle = ?, description = ?, url = ?, banner_image_url = ?, author_name = ?, publisher = ?, publish_year = ?, status = ?, updated_by = ?, key_media_banner = ? 
	WHERE key_books = ?
	');
	$stmt->bind_param('sssssssssiii',
	$_POST['title'],
	$_POST['subtitle'],
	$_POST['description'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['author_name'],
	$_POST['publisher'],
	$_POST['publish_year'],
	$status,
	$updatedBy,
	$_POST['key_media_banner'],
	$id
	);
	$stmt->execute();
	$conn->query("DELETE FROM book_categories WHERE key_books = $id");
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO book_categories (key_books, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $id, $catId);
			$stmtCat->execute();
		}
	}

}
?>