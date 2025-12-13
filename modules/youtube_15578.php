
<div class="block" style="<?= $css ?>">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_youtube_gallery, title FROM youtube_gallery ORDER BY RAND() LIMIT $number_of_records";
	$youtube_gallery = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $youtube_gallery->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_youtube_gallery'])) ? " class='active'" : "";
		echo "<li{$active}>{$c['title']}</li>";
	}
	echo "</ul>";
	echo "<p><a href='/youtube-gallery'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>