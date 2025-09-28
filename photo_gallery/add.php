<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
