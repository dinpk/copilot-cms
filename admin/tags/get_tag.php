<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$id = intval($_GET['id']);
$sql = "
			SELECT tags.*, media_library.file_url_thumbnail AS banner 
			FROM tags 
			LEFT JOIN media_library ON tags.key_media_banner = media_library.key_media 
			WHERE tags.key_tags = $id
";
$result = $conn->query($sql);
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>