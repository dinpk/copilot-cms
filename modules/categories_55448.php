
<div class="block" style="<?= $css ?>">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT DISTINCT c.key_categories, c.name, c.url
		FROM categories c
		INNER JOIN article_categories ac ON c.key_categories = ac.key_categories
		WHERE c.is_active = 1 
		ORDER BY c.name ASC LIMIT $number_of_records";
	$categories = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $categories->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_categories'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/category/{$c['url']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/categories'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>