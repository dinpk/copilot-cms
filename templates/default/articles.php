<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';
?>

<?php startLayout("Articles"); ?>


<div id="content">
	<h1>Articles</h1>
	<?php
	$page = max(1, intval($_GET['page'] ?? 1));
	$limit = 6;
	$offset = ($page - 1) * $limit;
	$sql = "SELECT a.*, m.file_url_thumbnail AS banner FROM articles a
							  LEFT JOIN media_library m ON a.key_media_banner = m.key_media
							  WHERE a.status='on' ";
	$sql .= " ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);
	while ($a = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
  			  <div><img src='{$a['banner']}' data-animate='fade'></div>
			  <div class='snippet-content'>
			  <h2>{$a['title']}</h2>
			  <p>{$a['article_snippet']}</p>
			  <a href='/article/{$a['url']}'>Read More</a>
			  </div>
			</div>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM articles WHERE status = 'on'";
	$total = $conn->query($countSql)->fetch_assoc()['total'];
	$totalPages = ceil($total / $limit);
	?>

	
	<div id='pager'>
	<?php
	if ($page > 1) {
		echo "<a href='?page=" . ($page - 1) . "'>⬅ Prev</a> ";
	}
	echo "Page $page of $totalPages ";
	if ($page < $totalPages) {
		echo "<a href='?page=" . ($page + 1) . "'>Next ➡</a>";
	}
	?>
	</div>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout();?>