
<div class="block" style="<?= $css ?>">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_articles, title, url FROM articles ORDER BY entry_date_time DESC LIMIT $number_of_records";
	$articles = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $articles->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_articles'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/article/{$c['url']}'>{$c['title']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/articles'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>