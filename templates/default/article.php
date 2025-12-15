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

	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>

	<article>
	<h1>
		<?= htmlspecialchars($article['title']) ?>
		<div><?= htmlspecialchars($article['title_sub']) ?></div>
	</h1>
	

	<?php
	if ($article['banner_image_url']) { // full link url
		echo "<div id='content-banner' style='background-image:url(" . $article['banner_image_url'] . ")'></div>";
	} else if ($article['banner_url']) { // media library file
		echo "<div id='content-banner' style='background-image:url(" . $article['banner_url'] . ")'></div>";
	}
	echo "<div>" . $article['article_content'] . "</div>";


	echo "<hr>";


	$authors = getAuthorsForArticle($conn, $article['key_articles']);
	$author_names = [];
	while ($author = $authors->fetch_assoc()) {
		$author_names[] = "<a href='/author/{$author['url']}'>" . htmlspecialchars($author['name']) . "</a>";
	}
	if (!empty($author_names)) echo "<b>" . getSetting('article_authors_label') . "</b>";
	echo "<p>" . implode(', ', $author_names) . "</p>";

	$content_types = getContentTypesForArticle($conn, $article['key_articles']);
	$content_type_names = [];
	while ($content_type = $content_types->fetch_assoc()) {
		$content_type_names[] = "<a href='/content-type/{$content_type['url']}'>" . htmlspecialchars($content_type['name']) . "</a>";
	}
	if (!empty($content_type_names)) echo "<b>" . getSetting('article_content_types_label') . "</b>";
	echo "<p>" . implode(', ', $content_type_names) . "</p>";

	$categories = getCategoriesForArticle($conn, $article['key_articles']);
	$category_names = [];
	while ($category = $categories->fetch_assoc()) {
		$category_names[] = "<a href='/category/{$category['url']}'>" . htmlspecialchars($category['name']) . "</a>";
	}
	if (!empty($category_names)) echo "<b>" . getSetting('article_categories_label') . "</b>";
	echo "<p>" . implode(', ', $category_names) . "</p>";

	$tags = getTagsForArticle($conn, $article['key_articles']);
	$tag_names = [];
	while ($tag = $tags->fetch_assoc()) {
		$tag_names[] = "<a href='/tag/{$tag['url']}'>" . htmlspecialchars($tag['name']) . "</a>";
	}
	if (!empty($tag_names)) echo "<b>" . getSetting('article_tags_label') . "</b>";
	echo "<p>" . implode(', ', $tag_names) . "</p>";

	?>
	</article>
	
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
	
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>