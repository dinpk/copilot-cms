<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$stmt = $conn->prepare('
	INSERT INTO 
	home_page_sections (title, content, image_url, target_url, section_type, sort, is_active, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('sssssiii',
		$_POST['title'],
		$_POST['content'],
		$_POST['image_url'],
		$_POST['target_url'],
		$_POST['section_type'],
		$_POST['sort'],
		$isActive,
		$_POST['key_media_banner']
	  );
	$stmt->execute();
}
?>