<?php
include '../db.php';
include '../users/auth.php';
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'products')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$createdBy = $_SESSION['key_user'];
	echo $createdBy.'<br>';
	$status = isset($_POST['status']) ? 'on' : 'off';
	$stmt = $conn->prepare('
	INSERT INTO products (title, description, sku, price, stock_quantity, product_type, url, status, sort, created_by) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('sssdisssii',
	$_POST['title'],
	$_POST['description'],
	$_POST['sku'],
	$_POST['price'],
	$_POST['stock_quantity'],
	$_POST['product_type'],
	$_POST['url'],
	$status,
	$_POST['sort'],
	$createdBy
	);
	$stmt->execute();
	$newId = $conn->insert_id;
	// Assign categories
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO product_categories (key_product, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $newId, $catId);
			$stmtCat->execute();
		}
	}
	// Log initial price
	$stmtPrice = $conn->prepare('INSERT INTO product_prices_history (key_product, old_price, new_price) VALUES (?, ?, ?)');
	$zero = 0.00;
	$stmtPrice->bind_param('idd', $newId, $zero, $_POST['price']);
	$stmtPrice->execute();
}
?>