<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM pages WHERE key_pages = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
