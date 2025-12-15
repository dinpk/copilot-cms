<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
$slug = $_GET['slug'] ?? '';
$category = getCategoryBySlug($conn, $slug);
if (!$category) {
  echo "⚠ Category not found.";
  exit;
}
startLayout("Category: " . htmlspecialchars($category['name']));
?>
<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<?php
	echo "<h1>Category: " . htmlspecialchars($category['name']) . "</h1>";
	if ($category['banner_image_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $category['banner_image_url'] . ")'></div>";
	} else if ($category['banner_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $category['banner_url'] . ")'></div>";
	}
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticlesForCategory($conn, $category['key_categories'], $page, getSetting('snippets_per_page'));
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
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout(); ?>
