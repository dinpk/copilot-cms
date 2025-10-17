<?php
session_start();
if (!isset($_SESSION['key_user'])) {
	header("Location: users/login.php");
	exit;
}

$username = $_SESSION["username"];

include("db.php");

// Utility functions
function getCount($table, $statusCol = 'status') {
	global $conn;
	$sql = "SELECT COUNT(*) as count FROM $table WHERE $statusCol = 'on'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	return $row["count"];
}

function getRecent($table, $titleCol, $dateCol, $limit = 5) {
	global $conn;

	$sql = "SELECT $titleCol, $dateCol FROM $table ORDER BY $dateCol DESC LIMIT $limit";
	$result = $conn->query($sql);

	$rows = [];
	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	return $rows;
}

// Metrics
$totalArticles = getCount("articles");
$totalPages = getCount("pages");
$totalVideos = getCount("youtube_gallery");
$totalPhotos = getCount("photo_gallery");
$totalBooks = getCount("books");

$totalProducts = getCount("products");
$totalAuthors = getCount("authors");
$totalOrders = getCount("product_orders", "status");

// Recent Articles
$recentArticles = getRecent("articles", "title", "entry_date_time", 5);
$recentBooks = getRecent("books", "title", "entry_date_time", 5);
$recentCategories = getRecent("categories", "name", "entry_date_time", 5);
$recentPages = getRecent("pages", "title", "entry_date_time", 5);
$recentAuthors = getRecent("authors", "name", "entry_date_time", 5);
$recentProducts = getRecent("products", "title", "entry_date_time", 5);
$recentGallery = getRecent("photo_gallery", "title", "entry_date_time", 5);
$recentYoutube = getRecent("youtube_gallery", "title", "entry_date_time", 5);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
	Dashboard
</header>
<div class="container">
	<div class="sidebar">
	<h2>Welcome, <?= $username ?></h2>
	<ul class="dashboard-links">
	<li><a href="index.php"><span>📊</span> Dashboard</a></li>
	<li><a href="main_menu/list.php"><span>🧭</span> Main Menu</a></li>
	<li><a href="articles/list.php"><span>📰</span> Articles</a></li>
	<li><a href="pages/list.php"><span>📄</span> Pages</a></li>
	<li><a href="categories/list.php"><span>🗂️</span> Categories</a></li>
	<li><a href="authors/list.php"><span>👤</span> Authors</a></li>
	<li><a href="books/list.php"><span>📖</span> Books</a></li>
	<li><a href="photo_gallery/list.php"><span>🖼️</span> Photo Gallery</a></li>
	<li><a href="youtube_gallery/list.php"><span>📺</span> YouTube Gallery</a></li>
	<li><a href="products/list.php"><span>📦</span> Products</a></li>
	<li><a href="blocks/list.php"><span>🧱</span> Blocks</a></li>
	<li><a href="users/list.php"><span>👥</span> Users</a></li>
	<li><a href="media_library/list.php"><span>🎞️</span> Media Library</a></li>
	<li><a href="settings/list.php"><span>⚙️</span> Settings</a></li>
	<li><a href="users/logout.php"><span>🚪</span> Logout</a></li>
	</ul>
	</div>

	<div class="main">
		<h2>📊 Dashboard Overview</h2>
		<div class="dashboard-metrics">
			<div class="metric-box">📰 Articles<br><span><?= $totalArticles ?></span></div>
			<div class="metric-box">👤 Authors<br><span><?= $totalAuthors ?></span></div>
			<div class="metric-box">📰 Pages<br><span><?= $totalPages ?></span></div>
			<div class="metric-box">📰 Videos<br><span><?= $totalVideos ?></span></div>
			<div class="metric-box">📰 Photos<br><span><?= $totalPhotos ?></span></div>
			<div class="metric-box">📚 Books<br><span><?= $totalBooks ?></span></div>
			<div class="metric-box" style="display:none;">🧱 Products<br><span><?= $totalProducts ?></span></div>
			<div class="metric-box" style="display:none;">🛒 Orders<br><span><?= $totalOrders ?></span></div>
		</div>
		<div class="recents">
			<div class="recent-activity">
				<h3>🕒 Recent Articles</h3>
				<ul>
				<?php foreach ($recentArticles as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= $item['entry_date_time'] ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3>🕒 Recent Books</h3>
				<ul>
				<?php foreach ($recentBooks as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3>🕒 Recent Pages</h3>
				<ul>
				<?php foreach ($recentPages as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3>🕒 Recent Categories</h3>
				<ul>
				<?php foreach ($recentCategories as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3>🕒 Recent Authors</h3>
				<ul>
				<?php foreach ($recentAuthors as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity" style="display:none;">
				<h3>🕒 Recent Products</h3>
				<ul>
				<?php foreach ($recentProducts	as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3>🕒 Recent Youtube</h3>
				<ul>
				<?php foreach ($recentYoutube as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3>🕒 Recent Photo Gallery</h3>
				<ul>
				<?php foreach ($recentGallery as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<p style="margin-top:2em; color:#666;">All changes are live. You’re in full control.</p>
	</div>
</div>

<footer>
	Powered by Copilot &mdash; Built with clarity, collaboration, and care.<br>
	&copy; <?= date('Y') ?> CopilotCMS.
</footer>

</body>
</html>
