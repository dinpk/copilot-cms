<?php include '../db.php';

if (!isset($_GET['id'])) {
  echo json_encode(['error' => 'Missing product ID']);
  exit;
}

$id = intval($_GET['id']);
$data = [];

// Fetch product details
$result = $conn->query("SELECT * FROM products WHERE key_product = $id LIMIT 1");
if ($row = $result->fetch_assoc()) {
  $data = $row;
}

// Fetch assigned categories
$catResult = $conn->query("SELECT key_categories FROM product_categories WHERE key_product = $id");
$categories = [];
while ($cat = $catResult->fetch_assoc()) {
  $categories[] = intval($cat['key_categories']);
}
$data['categories'] = $categories;

echo json_encode($data);
