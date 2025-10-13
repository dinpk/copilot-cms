
<div class="block">
	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

	$sql = "SELECT key_books, title, url FROM books ORDER BY entry_date_time DESC LIMIT 5";
	$books = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $books->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_books'])) ? " class='active'" : "";
		echo "<li{$active}><a href='/book/{$c['url']}'>{$c['title']}</a></li>";
	}
	echo "</ul>";
	echo "<p><a href='/books'>More</a></p>";
	?>
</div>