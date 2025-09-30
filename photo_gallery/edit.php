<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';	

  $stmt = $conn->prepare("UPDATE photo_gallery SET
    title = ?, image_url = ?, description = ?, status = ?,
    entry_date_time = CURRENT_TIMESTAMP
    WHERE key_photo_gallery = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssi",
    $_POST['title'],
    $_POST['image_url'],
    $_POST['description'],
    $status,
    $id
  );

  $stmt->execute();
  
  
	$conn->query("DELETE FROM photo_categories WHERE key_photo_gallery = $id");

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO photo_categories (key_photo_gallery, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $id, $catId);
		$stmtCat->execute();
	  }
	}
  
  
}

header("Location: list.php");
exit;
