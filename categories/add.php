<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$status = isset($_POST['status']) ? 'on' : 'off';

	$stmt = $conn->prepare("INSERT INTO categories (
	  name, description, url, sort, status, category_type
	) VALUES (?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("sssiss",
	  $_POST['name'],
	  $_POST['description'],
	  $_POST['url'],
	  $_POST['sort'],
	  $status,
	  $_POST['category_type']
	);

  $stmt->execute();
}

header("Location: list.php");
exit;
