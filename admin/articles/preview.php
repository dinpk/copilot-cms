<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 

if (!isset($_GET['id'])) {
  echo "⚠ No article ID provided.";
  exit;
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT a.*, m.file_url AS banner_url FROM articles a
                        LEFT JOIN media_library m ON a.key_media_banner = m.key_media
                        WHERE key_articles = $id");

$article = $result->fetch_assoc();
if (!$article) {
  echo "⚠ Article not found.";
  exit;
}

startLayout("Preview: " . htmlspecialchars($article['title']));
?>

<h1><?= htmlspecialchars($article['title']) ?></h1>
<h3><?= htmlspecialchars($article['title_sub']) ?></h3>
<img src="<?= htmlspecialchars($article['banner_url'] ?? $article['banner_image_url']) ?>" width="600"><br>
<p><em><?= htmlspecialchars($article['article_snippet']) ?></em></p>
<div><?= $article['article_content'] ?></div>

<?php endLayout(); ?>
