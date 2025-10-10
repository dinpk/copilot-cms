<?php 
include '../db.php';
include '../users/auth.php';

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "categories")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

	$status = isset($_POST['status']) ? 'on' : 'off';

	$stmt = $conn->prepare("INSERT INTO categories (
	  name, description, url, sort, status, category_type, key_media_banner
	) VALUES (?, ?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("sssissi",
	  $_POST['name'],
	  $_POST['description'],
	  $_POST['url'],
	  $_POST['sort'],
	  $status,
	  $_POST['category_type'],
	  $_POST['key_media_banner']
	);

  $stmt->execute();
}

header("Location: list.php");
exit;
