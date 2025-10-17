<?php
include '../db.php';
include '../users/auth.php';
$image_id = intval($_POST['image_id'] ?? 0);
$media_id = intval($_POST['media_id'] ?? 0);
if (!$image_id || !$media_id) {
	http_response_code(400);
	echo "Missing image or media ID";
	exit;
}
$sql = "UPDATE photo_gallery_images SET key_media_banner = $media_id WHERE key_image = $image_id";
$conn->query($sql);
?>