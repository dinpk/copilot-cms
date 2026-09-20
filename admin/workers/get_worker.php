<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$id = intval($_GET['id']);
$result = $conn->query("
	SELECT workers.*, media_library.file_url_thumbnail AS banner 
	FROM workers 
	LEFT JOIN media_library ON workers.key_media_banner = media_library.key_media 
	WHERE key_workers = $id
	");
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>