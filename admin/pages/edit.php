<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] == "viewer") {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  
	  if (isUrlTaken($_POST["url"], "pages", $id)) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }
	
  $status = isset($_POST['status']) ? 'on' : 'off';
  
  $stmt = $conn->prepare("UPDATE pages SET
    title = ?, page_content = ?, url = ?, status = ?,
    key_media_banner = ?
    WHERE key_pages = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssii",
    $_POST['title'],
    $_POST['page_content'],
    $_POST['url'],
    $status,
	$_POST['key_media_banner'],
    $id
  );

  $stmt->execute();
}

?>