<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor") {
    echo "⚠ You do not have access to add a record";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "authors")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }
	
	$status = isset($_POST['status']) ? 'on' : 'off';
	
	$createdBy = $_SESSION['key_user'];	
	
  $stmt = $conn->prepare("INSERT INTO authors (
    name, email, phone, website, url,
    social_url_media1, social_url_media2, social_url_media3,
    city, state, country, description, status, created_by, key_media_banner
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssssssssssii",
    $_POST['name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['website'],
    $_POST['url'],
    $_POST['social_url_media1'],
    $_POST['social_url_media2'],
    $_POST['social_url_media3'],
    $_POST['city'],
    $_POST['state'],
    $_POST['country'],
    $_POST['description'],
    $status,
	$createdBy,
	$_POST['key_media_banner']
  );

  $stmt->execute();
  
  
  
  
}
