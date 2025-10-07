<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM categories WHERE key_categories = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
