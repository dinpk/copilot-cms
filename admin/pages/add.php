<?php 
include '../db.php';
include '../users/auth.php';

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "pages")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

	  $status = isset($_POST['status']) ? 'on' : 'off';	
	  
	  $stmt = $conn->prepare("INSERT INTO pages (
		title, page_content, url, status, key_media_banner
	  ) VALUES (?, ?, ?, ?, ?)");

	  if (!$stmt) {
		die("Prepare failed: " . $conn->error);
	  }

	  $stmt->bind_param("ssssi",
		$_POST['title'],
		$_POST['page_content'],
		$_POST['url'],
		$status,
		$_POST['key_media_banner']
	  );

	  $stmt->execute();
}

