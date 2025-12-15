<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

startLayout(getSetting('tags_label')); 
?>

<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<h1><?= getSetting('tags_label') ?></h1>
	<article>
	<?php
	$records = getTags($conn);
	echo "<ul class='category-list'>";
	while ($record = $records->fetch_assoc()) {
		echo "<li><a href='/tag/{$record['url']}'>{$record['name']}</a></li>";
	}
	echo "</ul>
	<br>
	<hr>";
	?>
	</article>
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
