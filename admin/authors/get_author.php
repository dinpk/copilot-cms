<?php 
include '../db.php';
include '../users/auth.php';
$id = intval($_GET['id']);
$result = $conn->query("
	SELECT authors.*, media_library.file_url_thumbnail AS banner 
	FROM authors 
	LEFT JOIN media_library ON authors.key_media_banner = media_library.key_media 
	WHERE key_authors = $id
	");
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>