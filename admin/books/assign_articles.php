<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$book_id = intval($_POST['key_books']);
$article_ids = $_POST['article_ids'] ?? [];
$conn->query("DELETE FROM book_articles WHERE key_books = $book_id");
foreach ($article_ids as $aid) {
	$aid = intval($aid);
	$conn->query("INSERT INTO book_articles (key_books, key_articles) VALUES ($book_id, $aid)");
}
header("Location: list.php");
?>
