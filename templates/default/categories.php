<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/layout.php');
?>

<?php startLayout("Categories"); ?>


<div id="content">

	<h1>Categories</h1>

	<?php

	// Show category list
	$sql = "SELECT key_categories, name, url FROM categories WHERE status = 'on' ORDER BY name ASC";
	$categories = $conn->query($sql);
	echo "<ul class='category-list'>";
	while ($c = $categories->fetch_assoc()) {
		echo "<li><a href='/category/{$c['url']}'>{$c['name']}</a></li>";
	}
	echo "</ul><hr>";
	
	
	/* instead of showing category snippets on this page, we show it on /category/url



	$cat_id = isset($_GET['cat']) ? intval($_GET['cat']) : null;

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

		echo "<h3>Articles in Selected Category</h3><br>";
		while ($a = $records->fetch_assoc()) {
			echo "<div class='snippet-card'>
					<div>
						<h2>{$a['title']}</h2>
						<p>{$a['article_snippet']}</p>
						<a href='/article/{$a['url']}'>Read More</a>
					</div>
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
	
	*/
	


	
	?>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
