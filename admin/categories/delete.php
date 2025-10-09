<?php 
include '../db.php';
include '../users/auth.php';

if ($_SESSION["role"] != "admin") {
	echo "<script>alert('You do not have access to delete a record');history.back();</script>";
	exit;
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM categories WHERE key_categories = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
