<?php
include(__DIR__ . '/../../dbconnection.php');
$id = intval($_GET['id'] ?? 0);
$res = $conn->query("SELECT m.file_url, m.alt_text
FROM photo_gallery_images i
JOIN media_library m ON i.key_media_banner = m.key_media
WHERE i.key_photo_gallery = $id AND i.is_active = 1 
ORDER BY i.sort");
$images = [];
while ($img = $res->fetch_assoc()) {
  $images[] = $img;
}
header('Content-Type: application/json');
echo json_encode($images);
?>