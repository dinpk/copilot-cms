<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {

	$id = intval($_GET['id']);

	  if (isUrlTaken($_POST["url"], "categories", $id)) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

	$status = isset($_POST['status']) ? 'on' : 'off';


	$stmt = $conn->prepare("UPDATE categories SET
	  name = ?, description = ?, url = ?, sort = ?, status = ?, category_type = ?
	  WHERE key_categories = ?");

	$stmt->bind_param("sssissi",
	  $_POST['name'],
	  $_POST['description'],
	  $_POST['url'],
	  $_POST['sort'],
	  $status,
	  $_POST['category_type'],
	  $id
	);

  $stmt->execute();
}

?>