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

$authors = [];
if ($search !== '') {
    $search = $conn->real_escape_string($search);
    $res = $conn->query("SELECT key_authors, name FROM authors WHERE name LIKE '%$search%' ORDER BY name LIMIT 20");
    while ($row = $res->fetch_assoc()) {
        $authors[] = $row;
    }
}

// get already assigned authors with labels + names
$assigned = [];
$res2 = $conn->query("
    SELECT aa.key_authors, aa.article_work_label, a.name
    FROM article_authors aa
    JOIN authors a ON aa.key_authors = a.key_authors
    WHERE aa.key_articles = $article_id
");
while ($row2 = $res2->fetch_assoc()) {
    $assigned[] = $row2;
}


echo json_encode(['authors' => $authors, 'assigned' => $assigned]);
?>