<?php 
include '../db.php';
include '../users/auth.php';
$id = intval($_GET['id']);
$result = $conn->query("
			SELECT pages.*, media_library.file_url_thumbnail AS banner 
			FROM pages 
			LEFT JOIN media_library ON pages.key_media_banner = media_library.key_media 
			WHERE pages.key_pages = $id
		");
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>