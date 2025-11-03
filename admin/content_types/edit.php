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
	if (isUrlTaken($_POST['url'], 'content_types', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$stmt = $conn->prepare('
	UPDATE content_types 
	SET name = ?, description = ?, url = ?, banner_image_url = ?, sort = ?, status = ?, key_media_banner = ? 
	WHERE key_content_types = ?
	');
	$stmt->bind_param('ssssisii',
	$_POST['name'],
	$_POST['description'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['sort'],
	$status,
	$_POST['key_media_banner'],
	$id
	);
	$stmt->execute();
}
?>