<?php 
include '../db.php';
include '../users/auth.php';
$id = intval($_GET['id']);
$sql = "SELECT * FROM main_menu WHERE key_main_menu = $id";
$result = $conn->query($sql);
echo json_encode(cleanUtf8($result->fetch_assoc()));
