<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("UPDATE categories SET
    name = ?, description = ?, url = ?, sort = ?, status = ?
    WHERE key_categories = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssisi",
    $_POST['name'],
    $_POST['description'],
    $_POST['url'],
    $_POST['sort'],
    $_POST['status'],
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
