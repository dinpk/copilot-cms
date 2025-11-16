
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_tags, name, url FROM tags ORDER BY name ASC LIMIT  " . getSetting('module_total_records');
	$tags = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $tags->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_tags'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/tag/{$c['url']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/tags'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>