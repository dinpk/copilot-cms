<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM books WHERE key_books = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
