<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
startLayout("Authors"); 
?>
<div id="content">
	<h1>Authors</h1>
	<?php
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedAuthors($conn, $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
				<div><img src='{$record['banner']}' width='300'></div>
				<div>
					<h2>{$record['name']}</h2>
					<p>" . firstWords($record['description'], getSetting('snippet_words')) . "…" . "</p>
					<a href='/author/{$record['url']}'>Read More</a>
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