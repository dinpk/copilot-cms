<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $status = isset($_POST['status']) ? 'on' : 'off';	
  $stmt = $conn->prepare("INSERT INTO youtube_gallery (
    title, youtube_id, thumbnail_url, description, status
  ) VALUES (?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssss",
    $_POST['title'],
    $_POST['youtube_id'],
    $_POST['thumbnail_url'],
    $_POST['description'],
    $status
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
