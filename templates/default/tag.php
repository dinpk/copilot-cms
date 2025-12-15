<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
$slug = $_GET['slug'] ?? '';
$tag = getTagBySlug($conn, $slug);
if (!$tag) {
  echo "⚠ Tag not found.";
  exit;
}
startLayout("Tag: " . htmlspecialchars($tag['name']));
?>
<div id="content">
	<?php
	echo "<h1>Tag: " . htmlspecialchars($tag['name']) . "</h1>";
	if ($tag['banner_image_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $tag['banner_image_url'] . ")'></div>";
	} else if ($tag['banner_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $tag['banner_url'] . ")'></div>";
	}
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticlesForTag($conn, $tag['key_tags'], $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
	  echo "<div class='article-card'>
			  <img src='{$record['banner']}' width='300'>
			  <h2>{$record['title']}</h2>
			  <p>{$record['article_snippet']}</p>
			  <a href='/article/{$record['url']}'>" . getSetting('readmore_label') . "</a>
			</div>";
	}
	echo $pagination['html'];
	?>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout(); ?>
