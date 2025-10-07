<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "photo_gallery")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

  $status = isset($_POST['status']) ? 'on' : 'off';	
  $createdBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("INSERT INTO photo_gallery (
    title, url, image_url, description, status, created_by 
  ) VALUES (?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssi",
    $_POST['title'],
    $_POST['url'],
    $_POST['image_url'],
    $_POST['description'],
    $status,
	$createdBy
  );

  $stmt->execute();
  
  
	$newRecordId = $conn->insert_id;

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO photo_categories (key_photo_gallery, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $newRecordId, $catId);
		$stmtCat->execute();
	  }
	}
  
  

/*

if (!$stmt->execute()) {
  echo "Category insert error: " . $stmtCat->error;
}
print "<pre>" . print_r($_POST) . "</pre>";
*/
  
  
}

header("Location: list.php");
exit;
