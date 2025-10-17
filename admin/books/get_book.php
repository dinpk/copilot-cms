<?php
include '../db.php';
include '../users/auth.php';
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$result = $conn->query("
	SELECT books.*, media_library.file_url AS banner 
	FROM books 
	LEFT JOIN media_library ON books.key_media_banner = media_library.key_media 
	WHERE key_books = $id
	");
	$data = $result->fetch_assoc();
	$catRes = $conn->query("SELECT key_categories FROM book_categories WHERE key_books = $id");
	$assigned = [];
	while ($cat = $catRes->fetch_assoc()) {
		$assigned[] = (int)$cat['key_categories'];
	}
	$data['categories'] = $assigned;
	header('Content-Type: application/json');
	echo json_encode(cleanUtf8($data));
}
?>
