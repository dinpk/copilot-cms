<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM authors WHERE key_authors = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
