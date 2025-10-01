<?php
include '../db.php';
include '../users/auth.php';

$keyProduct = intval($_POST['key_product']);
$imageUrl = $_POST['image_url'];
$sortOrder = intval($_POST['sort_order'] ?? 0);

$stmt = $conn->prepare("INSERT INTO product_images (key_product, image_url, sort_order) VALUES (?, ?, ?)");
$stmt->bind_param("isi", $keyProduct, $imageUrl, $sortOrder);
$stmt->execute();

// Just return success
//echo "OK";
?>
