<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key_product'])) {
  $id = intval($_POST['key_product']);

  // Clear existing
  $conn->query("DELETE FROM product_categories WHERE key_product = $id");

  // Save new
  if (!empty($_POST['categories'])) {
    $stmt = $conn->prepare("INSERT IGNORE INTO product_categories (key_product, key_categories) VALUES (?, ?)");
    foreach ($_POST['categories'] as $catId) {
      $stmt->bind_param("ii", $id, $catId);
      $stmt->execute();
    }
  }
}

header("Location: list.php");
exit;
