
<div class="block" style="<?= $css ?>">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_pages, title, url FROM pages ORDER BY RAND() LIMIT $number_of_records";
	$pages = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $pages->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_pages'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/page/{$c['url']}'>{$c['title']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/pages'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>