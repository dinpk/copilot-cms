<?php
include_once('../db.php');
include_once( '../users/auth.php');
if ($_SESSION["role"] != "admin") {
	echo "<script>alert('You do not have access to delete a record');history.back();</script>";
	exit;
}
$key_proudct = $_GET['key_product'];
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$conn->query("DELETE FROM product_images WHERE key_image = $id");
	// Return updated image list
	include("get_images.php");
}
?>