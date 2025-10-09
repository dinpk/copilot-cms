<?php
include_once('../db.php');

$keyProduct = intval($_GET['key_product']);
$res = $conn->query("SELECT prod.key_image, m.file_url AS banner_url 
        FROM product_images prod
        LEFT JOIN media_library m ON prod.key_media_banner = m.key_media WHERE key_product = $keyProduct ORDER BY sort_order");

while ($img = $res->fetch_assoc()) {
  echo "<div style='margin-bottom:10px;'>
    <img src='{$img['banner_url']}' style='height:50px;'> 
    <a href='#' onclick='deleteImage({$img['key_image']}, $keyProduct)'>❌</a>
  </div>";
}
?>