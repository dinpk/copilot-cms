<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "books")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }
  
  $status = isset($_POST['status']) ? 'on' : 'off';	
  $createdBy = $_SESSION['key_user'];

	$stmt = $conn->prepare("INSERT INTO books (
		title, subtitle, description, url,
		author_name, publisher, publish_year, isbn, is_featured, language,
		format, weight_grams, sku, status, created_by, key_media_banner 
	) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("ssssssssisssisii",
		$_POST['title'],
		$_POST['subtitle'],
		$_POST['description'],
		$_POST['url'],
		$_POST['author_name'],
		$_POST['publisher'],
		$_POST['publish_year'],
		$_POST['isbn'],
		$_POST['is_featured'],
		$_POST['language'],
		$_POST['format'],
		$_POST['weight_grams'],
		$_POST['sku'],
		$status,
		$createdBy,
		$_POST['key_media_banner']
	);

  $stmt->execute();



	$newRecordId = $conn->insert_id;

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO book_categories (key_books, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $newRecordId, $catId);
		$stmtCat->execute();
	  }
	}


}
