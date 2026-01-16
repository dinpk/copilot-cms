<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
?>
<?php startLayout(getSetting('articles_label')); ?>
<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<h1><?= getSetting('articles_label') ?></h1>
	<article>
	<?php
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticles($conn, $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
		$banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
		$article_snippet = empty($record['article_snippet']) ? firstWords($record['article_content'], getSetting('snippet_words')) : $record['article_snippet'];
		echo "<div class='snippet-card'>
				  <div><a href='/article/{$record['url']}'><img src='$banner_url' data-animate='fade'></a></div>
				  <div class='snippet-content " . $record['content_direction'] . "'>
				  <h2><a href='/article/{$record['url']}'>{$record['title']}</a></h2>
				  <div>$article_snippet …<br><a href='/article/{$record['url']}'>" . getSetting('readmore_label') . "</a></div>
			  </div>
			</div>";
	}
	echo $pagination['html'];
	?>
	</article>
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout();?>