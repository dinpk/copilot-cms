
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_photo_gallery, title FROM photo_gallery ORDER BY RAND() LIMIT 5";
	$photo_gallery = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $photo_gallery->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_photo_gallery'])) ? " class='active'" : "";
		echo "<li{$active}>{$c['title']}</li>";
	}
	echo "</ul>";
	echo "<p><a href='/photo-gallery'>Albums</a></p>";
	?>
</div>