<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$book_id = intval($_GET['book_id']);
// INNER JOIN: Only those articles that have key in the junction table 'book_articles'
$result = $conn->query("
	SELECT articles.key_articles, articles.title FROM articles 
	INNER JOIN book_articles ON articles.key_articles = book_articles.key_articles 
	WHERE book_articles.key_books = $book_id
");
$assigned = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode(cleanUtf8($assigned));
?>
