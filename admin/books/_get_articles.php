<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$book_id = intval($_GET['book_id']);
$articles = $conn->query("SELECT key_articles, title FROM articles WHERE is_active = 1 ORDER BY title ASC")->fetch_all(MYSQLI_ASSOC);
$assigned = $conn->query("SELECT key_articles FROM book_articles WHERE key_books = $book_id")->fetch_all(MYSQLI_ASSOC);
echo json_encode([
	'articles' => $articles,
	'assigned' => array_column($assigned, 'key_articles')
]);

?>
