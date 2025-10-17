<?php
include '../db.php';
include '../users/auth.php';
$book_id = intval($_GET['book_id']);
$result = $conn->query("SELECT title FROM books WHERE key_books = $book_id");
$row = $result->fetch_assoc();
echo json_encode(cleanUtf8(['title' => $row['title'] ?? 'Unknown Book']));
?>
