<?php
include '../db.php';
include '../users/auth.php';

$keyPhotoGallery = intval($_POST['key_photo_gallery']);
$sortOrder = intval($_POST['sort_order'] ?? 0);

$stmt = $conn->prepare("INSERT INTO photo_gallery_images (key_photo_gallery, key_media_banner,  sort_order) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $keyPhotoGallery, $_POST['key_media_banner'], $sortOrder);
$stmt->execute();

?>
