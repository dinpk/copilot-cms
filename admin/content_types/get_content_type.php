<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$id = intval($_GET['id']);
$sql = "
			SELECT content_types.*, media_library.file_url_thumbnail AS banner 
			FROM content_types 
			LEFT JOIN media_library ON content_types.key_media_banner = media_library.key_media 
			WHERE content_types.key_content_types = $id
";
$result = $conn->query($sql);
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>