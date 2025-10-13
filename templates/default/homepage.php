<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/admin/db.php';
include 'layout.php';
?>

<?php startLayout("Home"); ?>

<div id="content">
	<?php
	$articles = $conn->query("SELECT a.*, m.file_url AS banner FROM articles a
							  LEFT JOIN media_library m ON a.key_media_banner = m.key_media
							  WHERE a.status='on' ORDER BY a.entry_date_time DESC LIMIT 10");

	while ($a = $articles->fetch_assoc()) {
	  echo "<div class='snippet-card'>
			  <div><img src='{$a['banner']}' data-animate='fade'></div>
			  <div class='snippet-content'>
			  <h2>{$a['title']}</h2>
			  <p>{$a['article_snippet']}</p>
			  <a href='/article/{$a['url']}'>Read More</a>
			  </div>
			</div>";
	}
	?>

</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>


<?php endLayout(); ?>