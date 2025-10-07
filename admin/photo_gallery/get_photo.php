<?php
include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $result = $conn->query("SELECT * FROM photo_gallery WHERE key_photo_gallery = $id");
  $data = $result->fetch_assoc();

  // Fetch assigned categories
  $catRes = $conn->query("SELECT key_categories FROM photo_categories WHERE key_photo_gallery = $id");
  $assigned = [];
  while ($cat = $catRes->fetch_assoc()) {
    $assigned[] = (int)$cat['key_categories']; // because as a string it won't match with js comparison in editItem().
  }
  $data['categories'] = $assigned;

  header('Content-Type: application/json');
  echo json_encode($data);
}
?>