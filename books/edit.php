<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("UPDATE books SET
    title = ?, subtitle = ?, description = ?, cover_image_url = ?, url = ?,
    author_name = ?, publisher = ?, publish_year = ?, status = ?,
    update_date_time = CURRENT_TIMESTAMP
    WHERE key_books = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssssssi",
    $_POST['title'],
    $_POST['subtitle'],
    $_POST['description'],
    $_POST['cover_image_url'],
    $_POST['url'],
    $_POST['author_name'],
    $_POST['publisher'],
    $_POST['publish_year'],
    $_POST['status'],
    $id
  );

  $stmt->execute();
  
	  
	$selectedCategories = $_POST['categories'] ?? [];
	// Clear old assignments
	$conn->query("DELETE FROM book_categories WHERE key_books = $id");
	// Insert new ones
	$stmt = $conn->prepare("INSERT INTO book_categories (key_books, key_categories) VALUES (?, ?)");
	foreach ($selectedCategories as $catId) {
	  $catId = intval($catId);
	  $stmt->bind_param("ii", $id, $catId);
	  $stmt->execute();
	}
	$stmt->close();
  
}

header("Location: list.php");
exit;
