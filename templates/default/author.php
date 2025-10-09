<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get author info
$author = $conn->query("SELECT * FROM authors WHERE url = '$slug'")->fetch_assoc();
if (!$author) {
  echo "⚠ Author not found.";
  exit;
}

startLayout("Author: " . htmlspecialchars($author['name']));
echo "<h1>" . htmlspecialchars($author['name']) . "</h1>";

if (!empty($author['bio'])) {
  echo "<p><em>" . nl2br(htmlspecialchars($author['bio'])) . "</em></p>";
}

// Get articles by this author
$articles = $conn->query("SELECT a.*, m.file_url AS banner 
                          FROM articles a
                          JOIN article_authors aa ON a.key_articles = aa.key_articles
                          LEFT JOIN media_library m ON a.key_media_banner = m.key_media
                          WHERE aa.key_authors = {$author['key_authors']} AND a.status = 'on'
                          ORDER BY a.sort");

echo "<h2>Articles by " . htmlspecialchars($author['name']) . "</h2>";
while ($a = $articles->fetch_assoc()) {
  echo "<div class='article-card'>
          <img src='{$a['banner']}' width='300'>
          <h3>{$a['title']}</h3>
          <p>{$a['article_snippet']}</p>
          <a href='/article/{$a['url']}'>Read More</a>
        </div>";
}

endLayout();
?>