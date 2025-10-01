<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';	

  $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;

  $stmt = $conn->prepare("UPDATE main_menu SET
    title = ?, url = ?, sort = ?, parent_id = ?, status = ?
    WHERE key_main_menu = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssiisi",
    $_POST['title'],
    $_POST['url'],
    $_POST['sort'],
    $parent_id,
    $status,
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
