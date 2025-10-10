
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_youtube_gallery, title FROM youtube_gallery ORDER BY RAND() LIMIT 5";
	$youtube_gallery = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $youtube_gallery->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_youtube_gallery'])) ? " class='active'" : "";
		echo "<li{$active}>{$c['title']}</li>";
	}
	echo "</ul>";
	echo "<p><a href='/youtube-gallery'>Videos</a></p>";
	?>
</div>