<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$result = $conn->query("SELECT * FROM youtube_gallery WHERE key_youtube_gallery = $id");
	$data = $result->fetch_assoc();
	$catRes = $conn->query("SELECT key_categories FROM youtube_categories WHERE key_youtube_gallery = $id");
	$assigned = [];
	while ($cat = $catRes->fetch_assoc()) {
		$assigned[] = (int)$cat['key_categories']; // because as a string it won't match with js comparison in editItem().
	}
	$data['categories'] = $assigned;
	//header('Content-Type: application/json');
	echo json_encode(cleanUtf8($data));
}
?>