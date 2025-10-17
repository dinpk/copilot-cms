<?php 
include '../db.php';
include '../users/auth.php';
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$data = [];
	$result = $conn->query("SELECT * FROM users WHERE key_user = $id LIMIT 1");
	if ($row = $result->fetch_assoc()) {
		$data = $row;
	}
	echo json_encode(cleanUtf8($data));
}
?>