<?php
include_once('../db.php');

$keyPhotoGallery = intval($_GET['key_photo_gallery']);
$res = $conn->query("SELECT photogal.key_image, m.file_url AS banner_url 
        FROM photo_gallery_images photogal
        LEFT JOIN media_library m ON photogal.key_media_banner = m.key_media WHERE key_photo_gallery = $keyPhotoGallery ORDER BY sort_order");

while ($img = $res->fetch_assoc()) {
  echo "<div style='margin-bottom:10px;'>
    <img src='{$img['banner_url']}' style='height:50px;'> 
    <a href='#' onclick='deleteImage({$img['key_image']}, $keyPhotoGallery)'>❌</a>
  </div>";
}
?>