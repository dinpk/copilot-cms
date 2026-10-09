<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$id = intval($_GET['id']);
$result = $conn->query("
			SELECT home_page_sections.*, media_library.file_url_thumbnail AS banner 
			FROM home_page_sections  
			LEFT JOIN media_library ON home_page_sections.key_media_banner = media_library.key_media 
			WHERE home_page_sections.key_home_page_sections = $id
		");
echo json_encode(cleanUtf8($result->fetch_assoc()));
?>