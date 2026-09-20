<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');

$article_id = intval($_POST['key_articles']);
$worker_ids = $_POST['worker_ids'] ?? [];
$work_labels = $_POST['work_labels'] ?? [];

$conn->query("DELETE FROM article_workers WHERE key_articles = $article_id");

foreach ($worker_ids as $aid) {
    $aid = intval($aid);
    $label = $conn->real_escape_string($work_labels[$aid] ?? '');
    $conn->query("INSERT INTO article_workers (key_articles, key_workers, article_work_label) 
                  VALUES ($article_id, $aid, '$label')");
}

header("Location: " .  $_SERVER['HTTP_REFERER']);
?>
