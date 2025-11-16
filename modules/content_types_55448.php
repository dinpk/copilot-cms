
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT DISTINCT c.key_content_types, c.name, c.url
		FROM content_types c
		INNER JOIN article_content_types ac ON c.key_content_types = ac.key_content_types
		WHERE c.is_active = 1 
		ORDER BY c.name ASC LIMIT " . getSetting('module_total_records');
	$content_types = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $content_types->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_content_types'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/content-type/{$c['url']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/content-types'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>