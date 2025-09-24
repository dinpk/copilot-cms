<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("UPDATE main_menu SET
    title = ?, url = ?, sort = ?, status = ?
    WHERE key_main_menu = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssisi",
    $_POST['title'],
    $_POST['url'],
    $_POST['sort'],
    $_POST['status'],
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
