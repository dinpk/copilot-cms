<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';
?>

<?php startLayout("Info / About"); ?>



<div id="content">

	<h1>Info / About</h1>
	<?php
	$page = max(1, intval($_GET['page'] ?? 1));
	$limit = 6;
	$offset = ($page - 1) * $limit;
	$sql = "SELECT title, page_content, url FROM pages WHERE status = 'on'";
	$sql .= " ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);
	while ($a = $records->fetch_assoc()) {
		echo "<div class='snippet-card'>
			  <h2>{$a['title']}</h2>
			  <p>" . firstWords($a['page_content'], 40) . "</p>
			  <a href='/page/{$a['url']}'>Read More</a>
			</div>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM pages WHERE status = 'on'";
	$total = $conn->query($countSql)->fetch_assoc()['total'];
	$totalPages = ceil($total / $limit);
	?>

	<br><hr>
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