<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get category info
$category = $conn->query("SELECT c.*, m.file_url AS banner_url 
                          FROM categories c 
                          LEFT JOIN media_library m ON c.key_media_banner = m.key_media 
                          WHERE c.url = '$slug'")->fetch_assoc();
if (!$category) {
  echo "⚠ Category not found.";
  exit;
}

startLayout("Category: " . htmlspecialchars($category['name']));

?>

<div id="content">

	<?php

	// PAGINATION NEEDED

	echo "<h1>Category: " . htmlspecialchars($category['name']) . "</h1>";

	if ($category['banner_image_url']) { // pasted link url from articles table
		echo "<div id='main-banner' style='background-image:url(" . $category['banner_image_url'] . ")'></div>";
	} else if ($category['banner_url']) { // uploaded file url from media_library table
		echo "<div id='main-banner' style='background-image:url(" . $category['banner_url'] . ")'></div>";
	}

	// Get articles in this category
	$articles = $conn->query("SELECT a.*, m.file_url AS banner 
							  FROM articles a
							  JOIN article_categories ac ON a.key_articles = ac.key_articles
							  LEFT JOIN media_library m ON a.key_media_banner = m.key_media
							  WHERE ac.key_categories = {$category['key_categories']} AND a.status = 'on'
							  ORDER BY a.sort");

	while ($a = $articles->fetch_assoc()) {
	  echo "<div class='article-card'>
			  <img src='{$a['banner']}' width='300'>
			  <h2>{$a['title']}</h2>
			  <p>{$a['article_snippet']}</p>
			  <a href='/article/{$a['url']}'>Read More</a>
			</div>";
	}
	?>

</div>


<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>


<?php endLayout(); ?>