<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$id = intval($_GET['id']);
$sql = "
			SELECT categories.*, media_library.file_url_thumbnail AS banner 
			FROM categories 
			LEFT JOIN media_library ON categories.key_media_banner = media_library.key_media 
			WHERE categories.key_categories = $id
";
$result = $conn->query($sql);
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>