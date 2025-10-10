
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_categories, name FROM categories ORDER BY name ASC LIMIT 5";
	$categories = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $categories->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_categories'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/categories?cat={$c['key_categories']}'>{$c['name']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/categories'>More</a></p>";
	?>
</div>