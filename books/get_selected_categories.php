<?php
require 'db.php'; // or your connection file

$id = intval($_GET['id'] ?? 0);
$selected = [];

$res = $conn->query("SELECT key_categories FROM book_categories WHERE key_books = $id");
while ($row = $res->fetch_assoc()) {
  $selected[] = $row['key_categories'];
}

echo json_encode($selected);
