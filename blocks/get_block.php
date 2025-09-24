<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM blocks WHERE key_blocks = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
