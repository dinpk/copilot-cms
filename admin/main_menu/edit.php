<?php
include '../db.php';
include '../users/auth.php';
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$status = isset($_POST['status']) ? 'on' : 'off';
	$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
	$stmt = $conn->prepare('
	UPDATE main_menu 
	SET title = ?, url_link = ?, sort = ?, parent_id = ?, status = ? 
	WHERE key_main_menu = ?
	');
	$stmt->bind_param('ssiisi',
	$_POST['title'],
	$_POST['url_link'],
	$_POST['sort'],
	$parent_id,
	$status,
	$id
	);
	$stmt->execute();
}
?>