<div class="block" style="<?= $css ?>">
	<?php
	$sql = "
			SELECT articles.*, media_library.file_url AS banner 
			FROM articles 
			JOIN article_tags ON articles.key_articles = article_tags.key_articles 
			LEFT JOIN media_library ON articles.key_media_banner = media_library.key_media 
			WHERE article_tags.key_tags = $key_tags AND articles.is_active = 1 
			ORDER BY entry_date_time DESC LIMIT $number_of_records";
	$articles = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($record = $articles->fetch_assoc()) {
		echo "<li><a href='/article/{$record['url']}'>{$record['title']}</a></li>";
	}
	echo "</ul>";
	
	$tagURLResults = $conn->query("SELECT url FROM tags WHERE key_tags = $key_tags");
	$record = $tagURLResults->fetch_assoc();
	$tagURL = $record['url'];
	echo "<p><a href='/tag/$tagURL'>" . getSetting('module_more_label') . "</a></p>";
	?>
</div>