<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM articles WHERE key_articles = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
