<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ($_SESSION["role"] != "admin") {
	echo "<script>alert('You do not have access to delete a record');history.back();</script>";
	exit;
}
if (isset($_GET['image_id'])) {
	$image_id = intval($_GET['image_id']);
	$conn->query("DELETE FROM photo_gallery_images WHERE key_image=$image_id");
}
header("Location: " .  $_SERVER['HTTP_REFERER']);
exit;
?>