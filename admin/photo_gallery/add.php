<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "photo_gallery")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

  $available_for_blocks = isset($_POST['available_for_blocks']) ? 'on' : 'off';	
  $status = isset($_POST['status']) ? 'on' : 'off';	
  $createdBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("INSERT INTO photo_gallery (
    title, url, image_url, description, available_for_blocks, status, created_by, key_media_banner 
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssii",
    $_POST['title'],
    $_POST['url'],
    $_POST['image_url'],
    $_POST['description'],
    $available_for_blocks,
    $status,
	$createdBy,
	$_POST['key_media_banner']
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
