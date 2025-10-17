<?php 
include '../db.php';
include '../users/auth.php'; 
if ($_SESSION["role"] != "admin") {
	echo "<script>alert('You do not have access to delete a record');history.back();</script>";
	exit;
}
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$conn->query("UPDATE settings SET is_active = 0 WHERE key_settings = $id");
}
?>