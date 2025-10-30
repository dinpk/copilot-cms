<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? '';
$article = getArticleBySlug($conn, $slug);
if (!$article) {
  echo "⚠ Article not found or not published.";
  exit;
}
startLayout(htmlspecialchars($article['title']));
?>

<div id="content">
	<article>
	<h1><?= htmlspecialchars($article['title']) ?></h1>
	<h3><?= htmlspecialchars($article['title_sub']) ?></h3>

	<?php
	if ($article['banner_image_url']) { // full link url
		echo "<div id='content-banner' style='background-image:url(" . $article['banner_image_url'] . ")'></div>";
	} else if ($article['banner_url']) { // media library file
		echo "<div id='content-banner' style='background-image:url(" . $article['banner_url'] . ")'></div>";
	}
	echo "<p><em>" . htmlspecialchars($article['article_snippet']) . "</em></p>";
	echo "<div>" . $article['article_content'] . "</div>";
	echo "<hr>";

	$authors = getAuthorsForArticle($conn, $article['key_articles']);
	$author_names = [];
	while ($author = $authors->fetch_assoc()) {
		$author_names[] = "<a href='/author/{$author['url']}'>" . htmlspecialchars($author['name']) . "</a>";
	}
	echo "<p><strong>By:</strong> " . implode(', ', $author_names) . "</p>";

	$categories = getCategoriesForArticle($conn, $article['key_articles']);
	$category_names = [];
	while ($category = $categories->fetch_assoc()) {
		$category_names[] = "<a href='/category/{$category['url']}'>" . htmlspecialchars($category['name']) . "</a>";
	}
	echo "<p><strong>Categories:</strong> " . implode(', ', $category_names) . "</p>";
	?>
	</article>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>