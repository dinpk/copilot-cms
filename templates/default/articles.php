<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';



startLayout("Articles");
echo "<h1>Articles</h1>";

$page = max(1, intval($_GET['page'] ?? 1));
$limit = 6;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM articles WHERE status = 'on'";

$sql .= " ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";

$articles = $conn->query($sql);

while ($a = $articles->fetch_assoc()) {
  echo "<div class='article-card'>
          <h2>{$a['title']}</h2>
          <p>{$a['article_snippet']}</p>
          <a href='/article/{$a['url']}'>Read More</a>
        </div>";
}



// Pagination
$countSql = "SELECT COUNT(*) AS total FROM articles WHERE status = 'on'";
$total = $conn->query($countSql)->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);

echo "<br><hr><div id='pager'>";
if ($page > 1) {
  echo "<a href='?page=" . ($page - 1) . "'>⬅ Prev</a> ";
}
echo "Page $page of $totalPages ";
if ($page < $totalPages) {
  echo "<a href='?page=" . ($page + 1) . "'>Next ➡</a>";
}
echo "</div>";


endLayout();
?>