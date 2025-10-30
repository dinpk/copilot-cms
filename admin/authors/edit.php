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
	if (isUrlTaken($_POST['url'], 'authors', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$status = isset($_POST['status']) ? 'on' : 'off';
	$updatedBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	UPDATE authors 
	SET name = ?, email = ?, phone = ?, website = ?, url = ?, banner_image_url = ?, social_url_media1 = ?, social_url_media2 = ?, social_url_media3 = ?, city = ?, state = ?, country = ?, description = ?, status = ?, updated_by = ?, key_media_banner = ? 
	WHERE key_authors = ?
	');
	$stmt->bind_param('ssssssssssssssiii',
	$_POST['name'],
	$_POST['email'],
	$_POST['phone'],
	$_POST['website'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['social_url_media1'],
	$_POST['social_url_media2'],
	$_POST['social_url_media3'],
	$_POST['city'],
	$_POST['state'],
	$_POST['country'],
	$_POST['description'],
	$status,
	$updatedBy,
	$_POST['key_media_banner'],
	$id
	);
	$stmt->execute();
}
?>