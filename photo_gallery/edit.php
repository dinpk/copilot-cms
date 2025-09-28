<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("UPDATE photo_gallery SET
    title = ?, image_url = ?, description = ?, status = ?,
    entry_date_time = CURRENT_TIMESTAMP
    WHERE key_photo_gallery = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssi",
    $_POST['title'],
    $_POST['image_url'],
    $_POST['description'],
    $_POST['status'],
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
