<?php 
include '../db.php';
include '../users/auth.php';
$id = intval($_GET['id']);
$sql = "SELECT * FROM categories WHERE key_categories = $id";
$result = $conn->query($sql);
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>