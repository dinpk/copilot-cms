<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] == "viewer") {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
	
	$updatedBy = $_SESSION['key_user'];

  $id = intval($_GET['id']);

	  if (isUrlTaken($_POST["url"], "products", $id)) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }



  $status = isset($_POST['status']) ? 'on' : 'off';

  // Fetch current price for comparison
  $current = $conn->query("SELECT price FROM products WHERE key_product = $id")->fetch_assoc();
  $oldPrice = floatval($current['price']);
  $newPrice = floatval($_POST['price']);

  // Update product
  $stmt = $conn->prepare("UPDATE products SET
    title = ?, description = ?, sku = ?, price = ?, stock_quantity = ?,
    product_type = ?, url = ?, status = ?, sort = ?, updated_by = ? 
    WHERE key_product = ?");

  $stmt->bind_param("sssdisssiii",
    $_POST['title'],
    $_POST['description'],
    $_POST['sku'],
    $newPrice,
    $_POST['stock_quantity'],
    $_POST['product_type'],
    $_POST['url'],
    $status,
    $_POST['sort'],
	$updatedBy,
    $id
  );

  $stmt->execute();

  // Reassign categories
  $conn->query("DELETE FROM product_categories WHERE key_product = $id");

  if (!empty($_POST['categories'])) {
    $stmtCat = $conn->prepare("INSERT IGNORE INTO product_categories (key_product, key_categories) VALUES (?, ?)");
    foreach ($_POST['categories'] as $catId) {
      $stmtCat->bind_param("ii", $id, $catId);
      $stmtCat->execute();
    }
  }

  // Log price change if different
  if ($oldPrice !== $newPrice) {
    $stmtPrice = $conn->prepare("INSERT INTO product_prices_history (key_product, old_price, new_price) VALUES (?, ?, ?)");
    $stmtPrice->bind_param("idd", $id, $oldPrice, $newPrice);
    $stmtPrice->execute();
  }
}
?>