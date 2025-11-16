<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');
startLayout(getSetting('categories_label')); 
?>
<div id="content">
	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>
	<h1><?= getSetting('categories_label') ?></h1>
	<?php
	$categories = getCategories($conn);
	echo "<ul class='category-list'>";
	while ($category = $categories->fetch_assoc()) {
		echo "<li><a href='/category/{$category['url']}'>{$category['name']}</a></li>";
	}
	echo "</ul>
	<br>
	<hr>";
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
<?php endLayout(); ?>
