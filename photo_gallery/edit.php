<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';	
	$updatedBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("UPDATE photo_gallery SET
    title = ?, image_url = ?, description = ?, status = ?,
    updated_by = ? 
    WHERE key_photo_gallery = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssii",
    $_POST['title'],
    $_POST['image_url'],
    $_POST['description'],
    $status,
	$updatedBy,
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
