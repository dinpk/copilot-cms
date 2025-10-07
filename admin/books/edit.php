<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {

  $id = intval($_GET['id']);

	  if (isUrlTaken($_POST["url"], "books", $id)) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

  $status = isset($_POST['status']) ? 'on' : 'off';	
	$updatedBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("UPDATE books SET
    title = ?, subtitle = ?, description = ?, cover_image_url = ?, url = ?,
    author_name = ?, publisher = ?, publish_year = ?, status = ?,
    updated_by = ? 
    WHERE key_books = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssssssii",
    $_POST['title'],
    $_POST['subtitle'],
    $_POST['description'],
    $_POST['cover_image_url'],
    $_POST['url'],
    $_POST['author_name'],
    $_POST['publisher'],
    $_POST['publish_year'],
    $status,
	$updatedBy,
    $id
  );

  $stmt->execute();
 

	$conn->query("DELETE FROM book_categories WHERE key_books = $id");

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO book_categories (key_books, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $id, $catId);
		$stmtCat->execute();
	  }
	}
 
 
}
?>