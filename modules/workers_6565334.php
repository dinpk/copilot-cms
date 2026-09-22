
<div class="block" style="<?= $css ?>">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_workers, name, url FROM workers WHERE is_active = 1 ORDER BY name LIMIT $number_of_records";
	$workers = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $workers->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_workers'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/worker/{$c['url']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/workers'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>