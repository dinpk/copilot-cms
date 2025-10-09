<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get category info
$category = $conn->query("SELECT c.*, m.file_url AS banner 
                          FROM categories c 
                          LEFT JOIN media_library m ON c.key_media_banner = m.key_media 
                          WHERE c.url = '$slug'")->fetch_assoc();
if (!$category) {
  echo "⚠ Category not found.";
  exit;
}

startLayout("Category: " . htmlspecialchars($category['name']));
echo "<h1>Category: " . htmlspecialchars($category['name']) . "</h1>";


if ($category['banner']) {
  echo "<img src='" . htmlspecialchars($category['banner']) . "' width='600'><br>";
}

// Get articles in this category
$articles = $conn->query("SELECT a.*, m.file_url AS banner 
                          FROM articles a
                          JOIN article_categories ac ON a.key_articles = ac.key_articles
                          LEFT JOIN media_library m ON a.key_media_banner = m.key_media
                          WHERE ac.key_categories = {$category['key_categories']} AND a.status = 'on'
                          ORDER BY a.sort");

while ($a = $articles->fetch_assoc()) {
  echo "<div class='article-card'>
          <img src='{$a['banner']}' width='300'>
          <h2>{$a['title']}</h2>
          <p>{$a['article_snippet']}</p>
          <a href='/article/{$a['url']}'>Read More</a>
        </div>";
}

endLayout();
?>