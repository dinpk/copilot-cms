<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO books (
    title, subtitle, description, cover_image_url, url,
    author_name, publisher, publish_year, status
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssssss",
    $_POST['title'],
    $_POST['subtitle'],
    $_POST['description'],
    $_POST['cover_image_url'],
    $_POST['url'],
    $_POST['author_name'],
    $_POST['publisher'],
    $_POST['publish_year'],
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
