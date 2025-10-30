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
	$status = isset($_POST['status']) ? 'on' : 'off';
	$stmt = $conn->prepare('
	UPDATE pages 
	SET title = ?, page_content = ?, url = ?, banner_image_url = ?, status = ?, sort = ?, key_media_banner = ? 
	WHERE key_pages = ?
	');
	$stmt->bind_param('sssssiii',
	$_POST['title'],
	$_POST['page_content'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$status,
	$_POST['sort'],
	$_POST['key_media_banner'],
	$id
	);
	$stmt->execute();
}
?>
