<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

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
    $_POST['status'],
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
