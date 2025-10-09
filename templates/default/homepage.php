<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/db.php';
include 'layout.php';

startLayout("Home");

// Header Block
$header = $conn->query("SELECT block_content FROM blocks WHERE show_in_region='header' AND status='on' ORDER BY sort LIMIT 1")->fetch_assoc();
echo "<div class='header-block'>{$header['block_content']}</div>";

// Featured Articles
$articles = $conn->query("SELECT a.*, m.file_url AS banner FROM articles a
                          LEFT JOIN media_library m ON a.key_media_banner = m.key_media
                          WHERE a.status='on' ORDER BY sort LIMIT 3");

echo "<div class='featured-articles'>";
while ($a = $articles->fetch_assoc()) {
  echo "<div class='article-card'>
          <img src='{$a['banner']}' width='300'>
          <h2>{$a['title']}</h2>
          <p>{$a['article_snippet']}</p>
          <a href='/article/{$a['url']}'>Read More</a>
        </div>";
}
echo "</div>";

// Footer Block
$footer = $conn->query("SELECT block_content FROM blocks WHERE show_in_region='footer' AND status='on' ORDER BY sort LIMIT 1")->fetch_assoc();
if ($footer) echo "<div class='footer-block'>{$footer['block_content']}</div>";

endLayout();

?>