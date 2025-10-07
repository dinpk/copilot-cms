<?php
include '../db.php';

$book_id = intval($_GET['book_id']);
$result = $conn->query("SELECT a.key_articles, a.title FROM articles a
  JOIN book_articles ba ON a.key_articles = ba.key_articles
  WHERE ba.key_books = $book_id");

$assigned = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($assigned);
?>
