<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "blocks")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

  $status = isset($_POST['status']) ? 'on' : 'off';	

	$createdBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("INSERT INTO blocks (
    title, block_content, show_on_pages, show_in_region,
    sort, module_file, status, created_by
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

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
	$createdBy
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
