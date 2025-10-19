<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get author info
$author = $conn->query("SELECT authors.*, m.file_url AS banner_url FROM authors 
							  LEFT JOIN media_library m ON authors.key_media_banner = m.key_media 
							  WHERE authors.url = '$slug'")->fetch_assoc();
if (!$author) {
  echo "⚠ Author not found.";
  exit;
}

startLayout("Author: " . htmlspecialchars($author['name']));

?>

<div id="content">

	<?php

	echo "<h1>" . htmlspecialchars($author['name']) . "</h1>";

	if (!empty($author['description'])) {
	  echo "<p><em>" . $author['description'] . "</em></p>";
	}

	if ($author['banner_url']) { // from media_library table
		echo "<div id='main-banner' style='background-image:url(" . $author['banner_url'] . ")'></div>";
	} else if ($author['banner_image_url']) { // from articles table
		echo "<div id='main-banner' style='background-image:url(" . $author['banner_image_url'] . ")'></div>";
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
	  echo "<div class='snippert-card'>
				<div><img src='{$a['banner']}' width='300'></div>
				<div class='snippet-content'>
				  <h3>{$a['title']}</h3>
				  <p>{$a['article_snippet']}</p>
				  <a href='/article/{$a['url']}'>Read More</a>
				</div>
			</div>";
	}
	?>

</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>