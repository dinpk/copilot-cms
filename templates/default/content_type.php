<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
$slug = $_GET['slug'] ?? '';
$content_type = getContentTypeBySlug($conn, $slug);
if (!$content_type) {
  echo "⚠ Content type not found.";
  exit;
}
startLayout("Content: " . htmlspecialchars($content_type['name']));
?>
<div id="content">
	<?php
	echo "<h1>Content: " . htmlspecialchars($content_type['name']) . "</h1>";
	if ($content_type['banner_image_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $content_type['banner_image_url'] . ")'></div>";
	} else if ($content_type['banner_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $content_type['banner_url'] . ")'></div>";
	}
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticlesForContentType($conn, $content_type['key_content_types'], $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
	  echo "<div class='article-card'>
			  <img src='{$record['banner']}' width='300'>
			  <h2>{$record['title']}</h2>
			  <p>{$record['article_snippet']}</p>
			  <a href='/article/{$record['url']}'>Read More</a>
			</div>";
	}
	echo $pagination['html'];
	?>
</div>
<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout(); ?>
