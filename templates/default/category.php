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

	if ($category['banner_image_url']) { // full link url
		echo "<div id='content-banner'><img src='" . $category['banner_image_url'] . "'></div>";
	} else if ($category['banner_url']) { // media library file
		echo "<div id='content-banner'><img src='" . $category['banner_url'] . "'></div>";
	}

	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticlesForCategory($conn, $category['key_categories'], $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
		$banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
		$article_snippet = (empty($record['article_snippet']) ? firstWords($record['article_content'], getSetting('snippet_words')) : firstWords($record['article_snippet'], getSetting('snippet_words')));
		echo "<div class='snippet-card'>
  			  <div><a href='/article/{$record['url']}'><img src='$banner_url' data-animate='fade'></a></div>
			  <div class='snippet-content " . $record['content_direction'] . "'>
			  <h2><a href='/article/{$record['url']}'>{$record['title']}</a></h2>
			  <div>$article_snippet <a href='/article/{$record['url']}'>" . getSetting('readmore_label') . "</a></div>
			  </div>
			</div>";
	}
	echo $pagination['html'];
	?>
	<div id="below-content" style="display:none">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout(); ?>
