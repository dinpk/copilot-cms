<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] == "viewer") {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

	  if (isUrlTaken($_POST["url"], "photo_gallery", $id)) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }


  $available_for_blocks = isset($_POST['available_for_blocks']) ? 'on' : 'off';	
  $status = isset($_POST['status']) ? 'on' : 'off';	
	$updatedBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("UPDATE photo_gallery SET
    title = ?, url = ?, image_url = ?, description = ?, available_for_blocks = ?, status = ?,
    updated_by = ?, key_media_banner = ? 
    WHERE key_photo_gallery = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssiii",
    $_POST['title'],
    $_POST['url'],
    $_POST['image_url'],
    $_POST['description'],
    $available_for_blocks,
    $status,
	$updatedBy,
	$_POST['key_media_banner'],
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
?>