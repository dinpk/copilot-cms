<?php
include '../db.php';
include '../users/auth.php';

$key_image = intval($_GET['image_id'] ?? 0);
if (!$key_image) {
  echo json_encode(['error' => 'Missing image ID']);
  exit;
}

$result = $conn->query("SELECT * FROM photo_gallery_images WHERE key_image = $key_image");
if ($row = $result->fetch_assoc()) {
  echo json_encode($row);
} else {
  echo json_encode(['error' => 'Image not found']);
}
?>