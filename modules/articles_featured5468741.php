
<div class="block" style="<?= $css ?>">
	<?php
	$sql = "SELECT a.*, m.file_url_thumbnail AS banner
			FROM articles a 
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media
			WHERE a.is_active = 1 AND a.is_featured = 1 
			ORDER BY RAND()  
			LIMIT $number_of_records";
	$articles = $conn->query($sql);
	while ($record = $articles->fetch_assoc()) {
		$banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
		echo "<div style='margin-bottom:10px;'>
				<a href='/article/{$record['url']}'>
				<div style='line-height:1;'><img src='$banner_url' data-animate='fade'></div>
				<div style='background:#FFF;padding:3px;'>{$record['title']}</div>
				</a>
			</div>";
	}
	?>
</div>