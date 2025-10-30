<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$q = $conn->real_escape_string($_GET['q'] ?? '');
$book_id = intval($_GET['book_id']);
$result = $conn->query("
			SELECT key_articles, title FROM articles
			WHERE MATCH(title, title_sub,content_type, article_snippet, article_content) AGAINST ('$q*' IN BOOLEAN MODE) 
			AND key_articles NOT IN (SELECT key_articles FROM book_articles WHERE key_books = $book_id)
			LIMIT 10
		");
$articles = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode(cleanUtf8($articles));
?>
