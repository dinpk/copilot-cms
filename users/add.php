<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $status = isset($_POST['status']) ? 'on' : 'off';

  // Hash password
  $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$stmt = $conn->prepare("INSERT INTO users (
	  name, username, password_hash, email, role, status,
	  phone, address, city, state, country, description, url
	) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("sssssssssssss",
	  $_POST['name'],
	  $_POST['username'],
	  $passwordHash,
	  $_POST['email'],
	  $_POST['role'],
	  $status,
	  $_POST['phone'],
	  $_POST['address'],
	  $_POST['city'],
	  $_POST['state'],
	  $_POST['country'],
	  $_POST['description'],
	  $_POST['url']
	);


  $stmt->execute();
}

header("Location: list.php");
exit;
?>