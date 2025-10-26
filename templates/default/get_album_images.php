<?php
include __DIR__ . '/../../admin/db.php';
$id = intval($_GET['id'] ?? 0);
$res = $conn->query("SELECT m.file_url, m.alt_text
FROM photo_gallery_images i
JOIN media_library m ON i.key_media_banner = m.key_media
WHERE i.key_photo_gallery = $id
ORDER BY i.sort");
$images = [];
while ($img = $res->fetch_assoc()) {
  $images[] = $img;
}
header('Content-Type: application/json');
echo json_encode($images);
?>