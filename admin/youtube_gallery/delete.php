<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ($_SESSION["role"] != "admin") {
	echo "<script>alert('You do not have access to delete a record');history.back();</script>";
	exit;
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$conn->query("DELETE FROM youtube_gallery WHERE key_youtube_gallery=$id");
}
header("Location: " .  $_SERVER['HTTP_REFERER']);
exit;
?>
