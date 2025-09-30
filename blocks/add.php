<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $status = isset($_POST['status']) ? 'on' : 'off';	

  $stmt = $conn->prepare("INSERT INTO blocks (
    title, block_content, show_on_pages, show_in_region,
    sort, module_file, status
  ) VALUES (?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssiss",
    $_POST['title'],
    $_POST['block_content'],
    $_POST['show_on_pages'],
    $_POST['show_in_region'],
    $_POST['sort'],
    $_POST['module_file'],
    $status
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
