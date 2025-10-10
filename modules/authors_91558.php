
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_authors, name FROM authors ORDER BY RAND() LIMIT 5";
	$authors = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $authors->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_authors'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/authors?cat={$c['key_authors']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/authors'>More</a></p>";
	?>
</div>