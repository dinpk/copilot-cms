<?php
include '../db.php';
include '../users/auth.php';
$keyProduct = intval($_POST['key_product']);
$sortOrder = intval($_POST['sort_order'] ?? 0);
$stmt = $conn->prepare("INSERT INTO product_images (key_product, key_media_banner,  sort_order) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $keyProduct, $_POST['key_media_banner'], $sortOrder);
$stmt->execute();
?>
