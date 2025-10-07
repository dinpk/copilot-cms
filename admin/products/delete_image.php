<?php
include '../db.php';
include '../users/auth.php';

$id = intval($_GET['id']);
$conn->query("DELETE FROM product_images WHERE key_image = $id");

// Return updated image list
include 'get_images.php';
?>