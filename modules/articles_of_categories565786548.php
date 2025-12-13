<div class="block" style="<?= $css ?>">
	<?php
	$sql = "
			SELECT articles.*, media_library.file_url AS banner 
			FROM articles 
			JOIN article_categories ON articles.key_articles = article_categories.key_articles 
			LEFT JOIN media_library ON articles.key_media_banner = media_library.key_media 
			WHERE article_categories.key_categories = $key_categories AND articles.is_active = 1 
			ORDER BY entry_date_time DESC LIMIT $number_of_records";
	$articles = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($record = $articles->fetch_assoc()) {
		echo "<li><a href='/article/{$record['url']}'>{$record['title']}</a></li>";
	}
	echo "</ul>";
	$URLResults = $conn->query("SELECT url FROM categories WHERE key_categories = $key_categories");
	$record = $URLResults->fetch_assoc();
	$theURL = $record['url'];
	echo "<p><a href='/category/$theURL'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>