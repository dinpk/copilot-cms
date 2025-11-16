<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ($_SESSION["role"] != "admin") {
	echo "<script>alert('You do not have access to delete a record');history.back();</script>";
	exit;
}
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$conn->query("UPDATE users SET is_active = 0 WHERE key_user = $id");
}
header("Location: list.php");
exit;
?>