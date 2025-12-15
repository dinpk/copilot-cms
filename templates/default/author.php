<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? '';
$author = getAuthorBySlug($conn, $slug);
if (!$author) {
	echo "⚠ Author not found.";
	exit;
}
startLayout("Author: " . htmlspecialchars($author['name']));
?>
<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<?php
	echo "<h1>" . htmlspecialchars($author['name']) . "</h1>";
	if (!empty($author['description'])) {
	  echo "<p><em>" . $author['description'] . "</em></p>";
	}
	if ($author['banner_url']) { // from media_library table
		echo "<div id='content-banner' style='background-image:url(" . $author['banner_url'] . ")'></div>";
	} else if ($author['banner_image_url']) { // from articles table
		echo "<div id='content-banner' style='background-image:url(" . $author['banner_image_url'] . ")'></div>";
	}
	$articles = getArticlesForAuthor($conn, $author['key_authors']);
	echo "<h2>Articles by " . htmlspecialchars($author['name']) . "</h2>";
	while ($a = $articles->fetch_assoc()) {
	  echo "<div class='snippert-card'>
				<div><img src='{$a['banner']}' width='300'></div>
				<div class='snippet-content'>
				  <h3>{$a['title']}</h3>
				  <p>{$a['article_snippet']}</p>
				  <a href='/article/{$a['url']}'>" . getSetting('readmore_label') . "</a>
				</div>
			</div>";
	}
	?>
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout(); ?>