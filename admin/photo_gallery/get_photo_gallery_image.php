<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$key_image = intval($_GET['image_id'] ?? 0);
if (!$key_image) {
	echo json_encode(['error' => 'Missing image ID']);
	exit;
}
$result = $conn->query("
			SELECT photo_gallery_images.*, media_library.file_url_thumbnail AS banner 
			FROM photo_gallery_images 
			LEFT JOIN media_library ON photo_gallery_images.key_media_banner = media_library.key_media 
			WHERE photo_gallery_images.key_image = $key_image

");
if ($row = $result->fetch_assoc()) {
	echo json_encode($row);
} else {
	echo json_encode(['error' => 'Image not found']);
}
?>