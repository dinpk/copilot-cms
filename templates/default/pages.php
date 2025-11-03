<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
?>
<?php startLayout("Info / About"); ?>
<div id="content">
	<h1>Info / About</h1>
	<?php
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedPages($conn, $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
				<div><img src='{$record['banner']}' width='300'></div>
				<div class='snippet-content'>
					<h2>{$record['title']}</h2>
					<p>" . firstWords($record['page_content'], getSetting('snippet_words')) . "…" . "</p>
					<a href='/page/{$record['url']}'>Read More</a>
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