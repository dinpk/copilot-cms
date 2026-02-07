<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');

$article_id = intval($_POST['key_articles']);
$author_ids = $_POST['author_ids'] ?? [];
$work_labels = $_POST['work_labels'] ?? [];

$conn->query("DELETE FROM article_authors WHERE key_articles = $article_id");

foreach ($author_ids as $aid) {
    $aid = intval($aid);
    $label = $conn->real_escape_string($work_labels[$aid] ?? '');
    $conn->query("INSERT INTO article_authors (key_articles, key_authors, article_work_label) 
                  VALUES ($article_id, $aid, '$label')");
}

header("Location: " .  $_SERVER['HTTP_REFERER']);
?>
