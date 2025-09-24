<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO main_menu (
    title, url, sort, status
  ) VALUES (?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssis",
    $_POST['title'],
    $_POST['url'],
    $_POST['sort'],
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
