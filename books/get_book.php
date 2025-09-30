<?php
include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $result = $conn->query("SELECT * FROM books WHERE key_books = $id");
  $data = $result->fetch_assoc();

  // Fetch assigned categories
  $catRes = $conn->query("SELECT key_categories FROM book_categories WHERE key_books = $id");
  $assigned = [];
  while ($cat = $catRes->fetch_assoc()) {
    $assigned[] = (int)$cat['key_categories']; // a string it won't match with js comparison in editItem().
  }
  $data['categories'] = $assigned;

  header('Content-Type: application/json');
  echo json_encode($data);
}
?>












