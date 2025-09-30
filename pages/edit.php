<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';
  
  $stmt = $conn->prepare("UPDATE pages SET
    title = ?, page_content = ?, url = ?, banner_image_url = ?, status = ?,
    update_date_time = CURRENT_TIMESTAMP
    WHERE key_pages = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssi",
    $_POST['title'],
    $_POST['page_content'],
    $_POST['url'],
    $_POST['banner_image_url'],
    $status,
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
