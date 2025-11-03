
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_content_types, name, url FROM content_types ORDER BY name ASC LIMIT 5";
	$content_types = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $content_types->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_content_types'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/content/{$c['url']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/content-types'>More</a></p>";
	?>
</div>