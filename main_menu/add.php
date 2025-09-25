<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
  $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
	
  $stmt = $conn->prepare("INSERT INTO main_menu (
    title, url, sort, parent_id, status
  ) VALUES (?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssiis",
    $_POST['title'],
    $_POST['url'],
    $_POST['sort'],
	$parent_id,
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
