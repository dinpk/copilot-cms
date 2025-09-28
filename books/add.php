<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

	$stmt = $conn->prepare("INSERT INTO books (
		title, subtitle, description, cover_image_url, url,
		author_name, publisher, publish_year, isbn, price,
		stock_quantity, discount_percent, is_featured, language,
		format, weight_grams, sku, status
	) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("sssssssssdiiisssis",
		$_POST['title'],
		$_POST['subtitle'],
		$_POST['description'],
		$_POST['cover_image_url'],
		$_POST['url'],
		$_POST['author_name'],
		$_POST['publisher'],
		$_POST['publish_year'],
		$_POST['isbn'],
		$_POST['price'],
		$_POST['stock_quantity'],
		$_POST['discount_percent'],
		$_POST['is_featured'],
		$_POST['language'],
		$_POST['format'],
		$_POST['weight_grams'],
		$_POST['sku'],
		$_POST['status']
	);


  $stmt->execute();
  

	// Assign categories  
	$key_books = $conn->insert_id;

	$selectedCategories = $_POST['categories'] ?? [];
	$stmtCat = $conn->prepare("INSERT INTO book_categories (key_books, key_categories) VALUES (?, ?)");
	foreach ($selectedCategories as $catId) {
	  $catId = intval($catId);
	  if ($catId > 0) {
		$stmtCat->bind_param("ii", $key_books, $catId);
		$stmtCat->execute();
	  }
	}
	$stmtCat->close();
  
}

header("Location: list.php");
exit;
