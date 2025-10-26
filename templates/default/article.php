<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/db.php';
include 'layout.php'; 

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Fetch article by slug
$article = $conn->query("SELECT a.*, m.file_url AS banner_url 
                         FROM articles a 
                         LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
                         WHERE a.url = '$slug' AND a.status = 'on'")->fetch_assoc();

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
		if ($article['banner_image_url']) { // pasted link url from articles table
			echo "<div id='content-banner' style='background-image:url(" . $article['banner_image_url'] . ")'></div>";
		} else if ($article['banner_url']) { // uploaded file url from media_library table
			echo "<div id='content-banner' style='background-image:url(" . $article['banner_url'] . ")'></div>";
		}
	?>

	<p><em><?= htmlspecialchars($article['article_snippet']) ?></em></p>

	<div><?= unwantedTagsToParagraphs($article['article_content'], ['script']) ?></div>

	<hr>

	<!-- Authors -->
	<?php
	$authRes = $conn->query("SELECT name, url FROM authors 
							 JOIN article_authors ON authors.key_authors = article_authors.key_authors 
							 WHERE article_authors.key_articles = {$article['key_articles']}");

	$authors = [];
	while ($a = $authRes->fetch_assoc()) {
	  $authors[] = "<a href='/author/{$a['url']}'>" . htmlspecialchars($a['name']) . "</a>";
	}
	if ($authors) {
	  echo "<p><strong>By:</strong> " . implode(', ', $authors) . "</p>";
	}
	?>

	<!-- Categories -->
	<?php

	$catRes = $conn->query("SELECT name, categories.url FROM categories 
							JOIN article_categories ON categories.key_categories = article_categories.key_categories 
							WHERE article_categories.key_articles = {$article['key_articles']}");

	$categories = [];
	while ($c = $catRes->fetch_assoc()) {
	  $categories[] = "<a href='/category/{$c['url']}'>" . htmlspecialchars($c['name']) . "</a>";
	}
	if ($categories) {
	  echo "<p><strong>Categories:</strong> " . implode(', ', $categories) . "</p>";
	}
	?>
	</article>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
