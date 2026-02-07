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
	$conn->query("DELETE FROM product_categories WHERE key_product = $id");
	$conn->query("DELETE FROM product_prices_history WHERE key_product = $id");
	$conn->query("DELETE FROM products WHERE key_product = $id");
}
header("Location: " .  $_SERVER['HTTP_REFERER']);
exit;
?>