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
	if (isUrlTaken($_POST['url'], 'pages', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$stmt = $conn->prepare('
	UPDATE pages 
	SET title = ?, page_content = ?, url = ?, banner_image_url = ?, is_active = ?, sort = ?, key_media_banner = ? 
	WHERE key_pages = ?
	');
	$stmt->bind_param('ssssiiii',
	$_POST['title'],
	$_POST['page_content'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$isActive,
	$_POST['sort'],
	$_POST['key_media_banner'],
	$id
	);
	$stmt->execute();
}
?>
