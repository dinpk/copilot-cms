<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT pages.*, m.file_url AS banner 
				FROM pages 
				LEFT JOIN media_library m ON pages.key_media_banner = m.key_media 
				WHERE pages.key_pages = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
