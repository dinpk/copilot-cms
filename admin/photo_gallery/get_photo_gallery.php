<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$result = $conn->query("

		SELECT photo_gallery.*, media_library.file_url_thumbnail AS banner 
		FROM photo_gallery 
		LEFT JOIN media_library ON photo_gallery.key_media_banner = media_library.key_media 
		WHERE photo_gallery.key_photo_gallery = $id

		");
	$data = $result->fetch_assoc();
	$catRes = $conn->query("SELECT key_categories FROM photo_categories WHERE key_photo_gallery = $id"); // assigned categories
	$assigned = [];
	while ($cat = $catRes->fetch_assoc()) {
		$assigned[] = (int)$cat['key_categories']; // needed as an int by JavaScript
	}
	$data['categories'] = $assigned;
	header('Content-Type: application/json');
	echo json_encode(cleanUtf8($data));
}
?>