<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';	

  $stmt = $conn->prepare("UPDATE blocks SET
    title = ?, block_content = ?, show_on_pages = ?, show_in_region = ?,
    sort = ?, module_file = ?, status = ?,
    entry_date_time = CURRENT_TIMESTAMP
    WHERE key_blocks = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssissi",
    $_POST['title'],
    $_POST['block_content'],
    $_POST['show_on_pages'],
    $_POST['show_in_region'],
    $_POST['sort'],
    $_POST['module_file'],
    $status,
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
