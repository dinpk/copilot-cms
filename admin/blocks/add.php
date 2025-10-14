<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $status = isset($_POST['status']) ? 'on' : 'off';	

	$createdBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("INSERT INTO blocks (
    block_name, title, block_content, show_on_pages, show_in_region,
    sort, module_file, status, created_by, key_media_banner, key_photo_gallery
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssissiii",
    $_POST['block_name'],
    $_POST['title'],
    $_POST['block_content'],
    $_POST['show_on_pages'],
    $_POST['show_in_region'],
    $_POST['sort'],
    $_POST['module_file'],
	$status,
	$createdBy,
    $_POST['key_media_banner'],	
    $_POST['key_photo_gallery']	
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
