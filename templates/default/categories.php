<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';
?>

<?php startLayout("Categories"); ?>


<div id="content">

	<h1>Categories</h1>

	<?php
	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;



	// Show articles for selected category
	if ($cat_id) {
		$page = max(1, intval($_GET['page'] ?? 1));
		$limit = 6;
		$offset = ($page - 1) * $limit;

		$sql = "SELECT a.title, a.article_snippet, a.url
				FROM articles a
				JOIN article_categories ac ON a.key_articles = ac.key_articles
				WHERE ac.key_categories = ? AND a.status = 'on'
				ORDER BY a.entry_date_time DESC
				LIMIT $limit OFFSET $offset";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $cat_id);
		$stmt->execute();
		$records = $stmt->get_result();

		echo "<h2>Articles in Selected Category</h2>";
		while ($a = $records->fetch_assoc()) {
			echo "<div class='snippet-card'>
				  <h2>{$a['title']}</h2>
				  <p>{$a['article_snippet']}</p>
				  <a href='/article/{$a['url']}'>Read More</a>
				  </div>";
		}

		// Pagination
		$countSql = "SELECT COUNT(*) AS total
					 FROM articles a
					 JOIN article_categories ac ON a.key_articles = ac.key_articles
					 WHERE ac.key_categories = ? AND a.status = 'on'";
		$countStmt = $conn->prepare($countSql);
		$countStmt->bind_param("i", $cat_id);
		$countStmt->execute();
		$total = $countStmt->get_result()->fetch_assoc()['total'];
		$totalPages = ceil($total / $limit);

		echo "<br><hr><div id='pager'>";
		if ($page > 1) {
			echo "<a href='?cat=$cat_id&page=" . ($page - 1) . "'>⬅ Prev</a> ";
		}
		echo "Page $page of $totalPages ";
		if ($page < $totalPages) {
			echo "<a href='?cat=$cat_id&page=" . ($page + 1) . "'>Next ➡</a>";
		}
		echo "</div>";
	}
	
	
	// Show category list
	$sql = "SELECT key_categories, name FROM categories ORDER BY name ASC";
	$categories = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $categories->fetch_assoc()) {
		$active = ($cat_id === intval($c['key_categories'])) ? " class='active'" : "";
		echo "<li{$active}><a href='?cat={$c['key_categories']}'>{$c['name']}</a></li>";
	}
	echo "</ul><hr>";

	
	?>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
