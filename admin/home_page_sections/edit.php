<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$stmt = $conn->prepare('
	UPDATE home_page_sections 
	SET title = ?, content = ?, image_url = ?, target_url = ?, section_type = ?, is_active = ?, sort = ?, key_media_banner = ? 
	WHERE key_home_page_sections = ?
	');
	$stmt->bind_param('sssssiiii',
	$_POST['title'],
	$_POST['content'],
	$_POST['image_url'],
	$_POST['target_url'],
	$_POST['section_type'],
	$isActive,
	$_POST['sort'],
	$_POST['key_media_banner'],
	$id
	);
	$stmt->execute();
}
?>
