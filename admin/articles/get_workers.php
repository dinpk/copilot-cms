<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
$article_id = intval($_GET['article_id']);
$search = $_GET['search'] ?? '';

$where = '';
if ($search !== '') {
    $search = $conn->real_escape_string($search);
    $where = "WHERE name LIKE '%$search%'";
}

$workers = [];
if ($search !== '') {
    $search = $conn->real_escape_string($search);
    $res = $conn->query("SELECT key_workers, name FROM workers WHERE name LIKE '%$search%' ORDER BY name LIMIT 20");
    while ($row = $res->fetch_assoc()) {
        $workers[] = $row;
    }
}

// get already assigned workers with labels + names
$assigned = [];
$res2 = $conn->query("
    SELECT aa.key_workers, aa.article_work_label, a.name
    FROM article_workers aa
    JOIN workers a ON aa.key_workers = a.key_workers
    WHERE aa.key_articles = $article_id
");
while ($row2 = $res2->fetch_assoc()) {
    $assigned[] = $row2;
}


echo json_encode(['workers' => $workers, 'assigned' => $assigned]);
?>