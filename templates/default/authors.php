<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';
?>

<?php startLayout("Authors"); ?>


<div id="content">
	<h1>Authors</h1>
	<?php
	$page = max(1, intval($_GET['page'] ?? 1));
	$limit = 6;
	$offset = ($page - 1) * $limit;
	$sql = "SELECT authors.*, m.file_url_thumbnail AS banner FROM authors 
							  LEFT JOIN media_library m ON authors.key_media_banner = m.key_media
							  WHERE authors.status='on' ";
	$sql .= " ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);
	while ($a = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
				<div><img src='{$a['banner']}' width='300'></div>
				<div>
					<h2>{$a['name']}</h2>
					<p>" . firstWords($a['description'], 40) . "</p>
					<a href='/author/{$a['url']}'>Read More</a>
				</div>
			</div>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM authors WHERE status = 'on'";
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