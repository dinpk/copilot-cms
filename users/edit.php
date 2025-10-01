<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $status = isset($_POST['status']) ? 'on' : 'off';

  // Update basic fields
	$stmt = $conn->prepare("UPDATE users SET
	  username = ?, email = ?, role = ?, status = ?,
	  phone = ?, address = ?, city = ?, state = ?, country = ?, description = ?,
	  update_date_time = CURRENT_TIMESTAMP
	  WHERE key_user = ?");

	$stmt->bind_param("ssssssssssi",
	  $_POST['username'],
	  $_POST['email'],
	  $_POST['role'],
	  $status,
	  $_POST['phone'],
	  $_POST['address'],
	  $_POST['city'],
	  $_POST['state'],
	  $_POST['country'],
	  $_POST['description'],
	  $id
	);

  $stmt->execute();

  // If password is provided, update it
  if (!empty($_POST['password'])) {
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmtPwd = $conn->prepare("UPDATE users SET password_hash = ? WHERE key_user = ?");
    $stmtPwd->bind_param("si", $passwordHash, $id);
    $stmtPwd->execute();
  }
}

header("Location: list.php");
exit;
?>