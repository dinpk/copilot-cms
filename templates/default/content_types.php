<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

startLayout("Content Types"); 
?>

<div id="content">
	<h1>Content Types</h1>
	<?php
	$records = getContentTypes($conn);
	echo "<ul class='category-list'>";
	while ($record = $records->fetch_assoc()) {
		echo "<li><a href='/content/{$record['url']}'>{$record['name']}</a></li>";
	}
	echo "</ul>
	<br>
	<hr>";
	?>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
