<?php include '../db.php';

if (!isset($_GET['id'])) {
  die("Missing product ID.");
}

$id = intval($_GET['id']);

// Delete from product_categories
$conn->query("DELETE FROM product_categories WHERE key_product = $id");

// Delete from product_prices_history
$conn->query("DELETE FROM product_prices_history WHERE key_product = $id");

// Delete from products
$conn->query("DELETE FROM products WHERE key_product = $id");

header("Location: list.php");
exit;
