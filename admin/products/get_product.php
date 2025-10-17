<?php 
include '../db.php';
include '../users/auth.php';
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$data = [];
	$result = $conn->query("SELECT * FROM products WHERE key_product = $id LIMIT 1");
	if ($row = $result->fetch_assoc()) {
		$data = $row;
	}
	$catResult = $conn->query("SELECT key_categories FROM product_categories WHERE key_product = $id");
	$categories = [];
	while ($cat = $catResult->fetch_assoc()) {
		$categories[] = intval($cat['key_categories']);
	}
	$data['categories'] = $categories;
	echo json_encode(cleanUtf8($data));
}
?>