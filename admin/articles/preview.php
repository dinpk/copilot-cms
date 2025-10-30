<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
if (!isset($_GET['id'])) {
	echo "⚠ No article ID provided.";
	exit;
}
$id = intval($_GET['id']);
$result = $conn->query("
			SELECT articles.*, media_library.file_url AS banner_url 
			FROM articles 
			LEFT JOIN media_library ON articles.key_media_banner = media_library.key_media
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
