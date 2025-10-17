<?php
include '../db.php';
include '../users/auth.php';
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	if (isUrlTaken($_POST['url'], 'users', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$stmt = $conn->prepare('
	UPDATE users 
	SET name = ?, username = ?, email = ?, role = ?, status = ?, phone = ?, address = ?, city = ?, state = ?, country = ?, description = ?, url = ? 
	WHERE key_user = ?
	');
	$stmt->bind_param('ssssssssssssi',
	$_POST['name'],
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
	$_POST['url'],
	$id
	);
	$stmt->execute();
	if (!empty($_POST['password'])) {
		$passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$stmtPwd = $conn->prepare('UPDATE users SET password_hash = ? WHERE key_user = ?');
		$stmtPwd->bind_param('si', $passwordHash, $id);
		$stmtPwd->execute();
	}
}
?>