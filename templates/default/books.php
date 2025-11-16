<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
startLayout(getSetting('books_label')); 
?>
<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<h1><?= getSetting('books_label') ?></h1>
	<?php
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedBooks($conn, $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
				<div><img src='{$record['banner_url']}' width='300'></div>
				<div>
					<h2><a href='/book/{$record['url']}'>{$record['title']}</a></h2>
					<div>" . firstWords($record['description'], getSetting('snippet_words')) . "…" . " 
					<a href='/book/{$record['url']}'>" . getSetting('readmore_label') . "</a></div>
			  </div>
			</div>";
	}
	echo $pagination['html'];
	?>
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-left">
	<?php renderBlocks("sidebar_left"); ?>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>
<?php endLayout();?>