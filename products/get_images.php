<?php
include '../db.php';

$keyProduct = intval($_GET['key_product']);
$res = $conn->query("SELECT * FROM product_images WHERE key_product = $keyProduct ORDER BY sort_order");

while ($img = $res->fetch_assoc()) {
  echo "<div style='margin-bottom:10px;'>
    <img src='{$img['image_url']}' style='height:50px;'> 
    <a href='#' onclick='deleteImage({$img['key_image']}, $keyProduct)'>❌</a>
  </div>";
}
?>