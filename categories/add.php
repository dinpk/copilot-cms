<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO categories (
    name, description, url, sort, status
  ) VALUES (?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssis",
    $_POST['name'],
    $_POST['description'],
    $_POST['url'],
    $_POST['sort'],
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
