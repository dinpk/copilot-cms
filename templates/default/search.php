<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$q = $_GET['q'] ?? '';
$q = $conn->real_escape_string(trim($q));

$page = max(1, intval($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

startLayout("Search: " . htmlspecialchars($q));
?>

<div id="content">
	<form method="get" action="/search" class="search-form" style="padding:20px;margin-bottom:20px;border:1px solid #AAA;">
	  <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" placeholder="Search..."> 
	  <input type="submit" value="Search">
	</form>

	<?php
	if ($q) echo "<h1>Search Results for: " . htmlspecialchars($q) . "</h1>";
	$res = $conn->query("SELECT title, title_sub, article_snippet, url FROM articles WHERE status = 'on' AND MATCH(title, title_sub, article_snippet, article_content) AGAINST ('$q')
	LIMIT $limit OFFSET $offset
	");
	while ($a = $res->fetch_assoc()) {
		echo "<div><h3>{$a['title']}</h3><p>{$a['article_snippet']}</p><a href='/article/{$a['url']}'>Read More</a></div>";
	}
	$countSql = "SELECT COUNT(*) AS total FROM articles WHERE status = 'on' AND MATCH(title, title_sub, article_snippet, article_content) AGAINST ('$q')";
	$total = $conn->query($countSql)->fetch_assoc()['total'];
	$totalPages = ceil($total / $limit);

?>

	<div id='pager'>
	<?php
	if ($page > 1) {
		echo "<a href='?q=" . urlencode($q) . "&page=" . $page - 1 . "'>⬅ Prev</a> ";
	}
	echo "Page $page of $totalPages ";
	if ($page < $totalPages) {
		echo "<a href='?q=" . urlencode($q) . "&page=" . $page + 1 . "'>Next ➡</a>";
	}
	?>
	</div>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php
endLayout();
?>