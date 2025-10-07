<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "youtube_gallery")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

  $status = isset($_POST['status']) ? 'on' : 'off';	
  $createdBy = $_SESSION['key_user'];
  
  $stmt = $conn->prepare("INSERT INTO youtube_gallery (
    title, youtube_id, thumbnail_url, url, description, status, created_by 
  ) VALUES (?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssi",
    $_POST['title'],
    $_POST['youtube_id'],
    $_POST['thumbnail_url'],
    $_POST['url'],
    $_POST['description'],
    $status,
	$createdBy
  );

  $stmt->execute();
  
  
	$newRecordId = $conn->insert_id;

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO youtube_categories (key_youtube_gallery, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $newRecordId, $catId);
		$stmtCat->execute();
	  }
	}
  
}

header("Location: list.php");
exit;
