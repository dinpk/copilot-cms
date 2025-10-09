<?php 
include '../db.php';
include '../users/auth.php'; 

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM media_library WHERE key_media = $id");
echo json_encode($result->fetch_assoc());
?>