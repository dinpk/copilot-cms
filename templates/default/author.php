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
	echo "<h1>" . getSetting('articles_by_author_label') . " " . htmlspecialchars($author['name']) . "</h1>";
	if (!empty($author['description'])) {
	  echo "<p><em>" . $author['description'] . "</em></p>";
	}

	if ($author['banner_image_url']) { // full link url
		echo "<div id='content-banner'><img src='" . $author['banner_image_url'] . "'></div>";
	} else if ($author['banner_url']) { // media library file
		echo "<div id='content-banner'><img src='" . $author['banner_url'] . "'></div>";
	}

	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticlesForAuthor($conn, $author['key_authors'], $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];

	while ($a = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
				<div><a href='/article/{$a['url']}'><img src='{$a['banner']}' width='300' data-animate='fade'></a></div>
				<div class='snippet-content'>
				  <h2><a href='/article/{$a['url']}'>{$a['title']}</a></h2>
				  <div>{$a['article_snippet']}<br><a class='full-content-link' href='/article/{$a['url']}'>" . getSetting('readmore_label') . "</a></div>
				</div>
			  </div>";
	}

	echo $pagination['html'];


	?>
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout(); ?>