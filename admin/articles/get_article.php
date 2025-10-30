<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$result = $conn->query("
	SELECT a.*, m.file_url_thumbnail AS banner 
	FROM articles a 
	LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
	WHERE key_articles = $id
	");
	$data = $result->fetch_assoc();
	$catRes = $conn->query("SELECT key_categories FROM article_categories WHERE key_articles = $id");
	$assigned = [];
	while ($cat = $catRes->fetch_assoc()) {
		$assigned[] = (int)$cat['key_categories'];
	}
	$data['categories'] = $assigned;
	header('Content-Type: application/json');
	echo json_encode(cleanUtf8($data));
}
?>
