<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';	
  $updatedBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("UPDATE youtube_gallery SET
    title = ?, youtube_id = ?, thumbnail_url = ?, url = ?, description = ?, status = ?,
    updated_by = ? 
    WHERE key_youtube_gallery = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssii",
    $_POST['title'],
    $_POST['youtube_id'],
    $_POST['thumbnail_url'],
    $_POST['url'],
    $_POST['description'],
    $status,
	$updatedBy,
    $id
  );

  $stmt->execute();
  
  
	$conn->query("DELETE FROM youtube_categories WHERE key_youtube_gallery = $id");

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO youtube_categories (key_youtube_gallery, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $id, $catId);
		$stmtCat->execute();
	  }
	}
  
  
}

header("Location: list.php");
exit;
