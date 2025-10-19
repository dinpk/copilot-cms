<?php 
include '../db.php';
include '../users/auth.php';
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$data = [];
	$result = $conn->query("
			SELECT users.*, media_library.file_url_thumbnail AS banner 
			FROM users 
			LEFT JOIN media_library ON users.key_media_banner = media_library.key_media 
			WHERE users.key_user = $id
	");
	if ($row = $result->fetch_assoc()) {
		$data = $row;
	}
	echo json_encode(cleanUtf8($data));
}
?>