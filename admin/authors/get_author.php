<?php include '../db.php';

$id = intval($_GET['id']);
$sql = "SELECT authors.*, m.file_url AS banner FROM authors 
		LEFT JOIN media_library m ON authors.key_media_banner = m.key_media 
		WHERE key_authors = $id";
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc());
