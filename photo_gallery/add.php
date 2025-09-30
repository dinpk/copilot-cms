<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $status = isset($_POST['status']) ? 'on' : 'off';	

  $stmt = $conn->prepare("INSERT INTO photo_gallery (
    title, image_url, description, status
  ) VALUES (?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssss",
    $_POST['title'],
    $_POST['image_url'],
    $_POST['description'],
    $status
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
