<?php
include '../db.php';
include '../users/auth.php';
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
	$status = isset($_POST['status']) ? 'on' : 'off';
	$stmt = $conn->prepare('
	INSERT INTO main_menu (title, url_link, sort, parent_id, status) 
	VALUES (?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssiis',
	$_POST['title'],
	$_POST['url_link'],
	$_POST['sort'],
	$parent_id,
	$status
	);
	$stmt->execute();
}
?>
