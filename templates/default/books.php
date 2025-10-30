<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
startLayout("Books"); 
?>
<div id="content">
	<h1>Books</h1>
	<?php
	$page = intval($_GET['page'] ?? 1);
	$data = getPaginatedBooks($conn, $page, getSetting('snippets_per_page'));
	$records = $data['records'];
	$pagination = $data['pagination'];
	while ($record = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
				<div><img src='{$record['banner_url']}' width='300'></div>
				<div>
					<h2>{$record['title']}</h2>
					<p>" . firstWords($record['description'], getSetting('snippet_words')) . "…" . "</p>
					<a href='/book/{$record['url']}'>Read More</a>
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