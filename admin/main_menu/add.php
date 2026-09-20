<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$stmt = $conn->prepare('
	INSERT INTO main_menu (title, url_link, css_class, sort, parent_id, is_active) 
	VALUES (?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('sssiii',
	$_POST['title'],
	$_POST['url_link'],
	$_POST['css_class'],
	$_POST['sort'],
	$parent_id,
	$isActive
	);
	$stmt->execute();
}
?>
