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
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<?php
	echo "<h1>" . htmlspecialchars($content_type['name']) . "</h1>";
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
		$banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
		$article_snippet = (empty($record['article_snippet']) ? firstWords($record['article_content'], getSetting('snippet_words')) : firstWords($record['article_snippet'], getSetting('snippet_words')));
		echo "<div class='snippet-card'>
  			  <div><a href='/article/{$record['url']}'><img src='$banner_url' data-animate='fade'></a></div>
			  <div class='snippet-content'>
			  <h2><a href='/article/{$record['url']}'>{$record['title']}</a></h2>
			  <div>$article_snippet <a href='/article/{$record['url']}'>" . getSetting('readmore_label') . "</a></div>
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
