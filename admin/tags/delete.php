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
  $sql = "DELETE FROM tags WHERE key_tags = $id";
  $conn->query($sql);
}
header("Location: " .  $_SERVER['HTTP_REFERER']);
exit;
?>