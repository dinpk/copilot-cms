<?php
include_once('../db.php');
include '../users/auth.php';
$keyProduct = intval($_GET['key_product']);
$res = $conn->query('
		SELECT product_images.key_image, media_library.file_url AS banner_url 
		FROM product_images 
		LEFT JOIN media_library ON product_images.key_media_banner = media_library.key_media 
		WHERE key_product = $keyProduct 
		ORDER BY sort_order
		');
while ($img = $res->fetch_assoc()) {
	echo "<div style='margin-bottom:10px;'>
	<img src='{$img['banner_url']}' style='height:50px;'> 
	<a href='#' onclick='deleteImage({$img['key_image']}, $keyProduct)'>❌</a>
	</div>";
}
?>