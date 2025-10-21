<?php 
include '../db.php';
include '../users/auth.php';
$id = intval($_GET['id']);
$sql = "SELECT * FROM blocks WHERE key_blocks = $id";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$devices_array = explode(',', $data['visible_on']);
$data['visible_on'] = $devices_array;

echo json_encode(cleanUtf8($data));
?>