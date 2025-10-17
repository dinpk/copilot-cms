<?php 
include '../db.php';
include '../users/auth.php';
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$result = $conn->query("SELECT * FROM settings WHERE key_settings = $id");
	echo json_encode(cleanUtf8($result->fetch_assoc()));
}
?>