<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';	

  $stmt = $conn->prepare("UPDATE youtube_gallery SET
    title = ?, youtube_id = ?, thumbnail_url = ?, description = ?, status = ?,
    entry_date_time = CURRENT_TIMESTAMP
    WHERE key_youtube_gallery = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssi",
    $_POST['title'],
    $_POST['youtube_id'],
    $_POST['thumbnail_url'],
    $_POST['description'],
    $status,
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
