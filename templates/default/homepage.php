<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
?>
<?php startLayout("Home"); ?>
<div id="content">
	<?php
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticles($conn, $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	$words_limit = getSetting('snippet_words');
	while ($record = $records->fetch_assoc()) {
		$banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
		$article_snippet = (empty($record['article_snippet']) ? firstWords($record['article_content'], $words_limit) : firstWords($record['article_snippet'], $words_limit));
		echo "<div class='snippet-card'>
  			  <div><img src='$banner_url' data-animate='fade'></div>
			  <div class='snippet-content'>
			  <h2>{$record['title']}</h2>
			  <p>$article_snippet</p>
			  <a href='/article/{$record['url']}'>Read More</a>
			  </div>
			</div>";
	}
	echo $pagination['html'];
	?>
</div>
<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout();?>