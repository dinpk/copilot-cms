<?php
include '../db.php';
include '../users/auth.php';
$article_id = intval($_GET['article_id']);
$authors = $conn->query("SELECT key_authors, name FROM authors WHERE status = 'on' ORDER BY name ASC")->fetch_all(MYSQLI_ASSOC);
$assigned = $conn->query("SELECT key_authors FROM article_authors WHERE key_articles = $article_id")->fetch_all(MYSQLI_ASSOC);
echo json_encode(cleanUtf8([
	'authors' => $authors,
	'assigned' => array_column($assigned, 'key_authors')
]));
?>