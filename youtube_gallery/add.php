<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
