<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
?>
<?php startLayout("Articles"); ?>
<div id="content">
	<h1>Articles</h1>
	<?php
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticles($conn, $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
		$banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
		echo "<div class='snippet-card'>
  			  <div><img src='$banner_url' data-animate='fade'></div>
			  <div class='snippet-content'>
			  <h2>{$record['title']}</h2>
			  <p>{$record['article_snippet']}</p>
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