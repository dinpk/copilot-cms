
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_authors, name, url FROM authors ORDER BY RAND() LIMIT  " . getSetting('module_total_records');
	$authors = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $authors->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_authors'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/author/{$c['url']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/authors'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>