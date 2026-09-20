<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? '';
$worker = getWorkerBySlug($conn, $slug);
if (!$worker) {
	echo "⚠ Worker not found.";
	exit;
}
startLayout("Worker: " . htmlspecialchars($worker['name']));
?>
<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<?php
	echo "<h1>" . getSetting('articles_by_worker_label') . " " . htmlspecialchars($worker['name']) . "</h1>";
	if (!empty($worker['description'])) {
	  echo "<p><em>" . $worker['description'] . "</em></p>";
	}
	if ($worker['banner_url']) { // from media_library table
		echo "<div id='content-banner' style='background-image:url(" . $worker['banner_url'] . ")'></div>";
	} else if ($worker['banner_image_url']) { // from articles table
		echo "<div id='content-banner' style='background-image:url(" . $worker['banner_image_url'] . ")'></div>";
	}
	
	
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedArticlesForWorker($conn, $worker['key_workers'], $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];

	while ($a = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
				<div><a href='/article/{$a['url']}'><img src='{$a['banner']}' width='300' data-animate='fade'></a></div>
				<div class='snippet-content'>
				  <h2><a href='/article/{$a['url']}'>{$a['title']}</a></h2>
				  <div>{$a['article_snippet']}<br><a class='full-content-link' href='/article/{$a['url']}'>" . getSetting('readmore_label') . "</a></div>
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