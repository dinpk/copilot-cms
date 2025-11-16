<?php
session_start();
if (!isset($_SESSION['key_user'])) {
	header("Location: users/login.php");
	exit;
}

$username = $_SESSION["username"];

include("../dbconnection.php");

// Utility functions
function getCount($table, $statusCol = 'is_active') {
	global $conn;
	$sql = "SELECT COUNT(*) as count FROM $table WHERE $statusCol = 1";
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
$totalContentTypes = getCount("content_types");
$totalCategories = getCount("categories");
$totalTags = getCount("tags");

$totalProducts = getCount("products");
$totalAuthors = getCount("authors");
$totalOrders = getCount("product_orders");

// Recent Articles
$recentArticles = getRecent("articles", "title", "entry_date_time", 5);
$recentBooks = getRecent("books", "title", "entry_date_time", 5);
$recentPages = getRecent("pages", "title", "entry_date_time", 5);
$recentAuthors = getRecent("authors", "name", "entry_date_time", 5);
$recentProducts = getRecent("products", "title", "entry_date_time", 5);
$recentGallery = getRecent("photo_gallery", "title", "entry_date_time", 5);
$recentYoutube = getRecent("youtube_gallery", "title", "entry_date_time", 5);
$recentContentTypes = getRecent("content_types", "name", "entry_date_time", 5);
$recentCategories = getRecent("categories", "name", "entry_date_time", 5);
$recentTags = getRecent("tags", "name", "entry_date_time", 5);
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
		<h3>Welcome, <?= $username ?></h3>
		<a href="index.php"><img src="assets/images/icon-dashboard.png" class="sidebar-icon"> Dashboard</a>
		<a href="main_menu/list.php"><img src="assets/images/icon-main-menu.png" class="sidebar-icon"> Main Menu</a>
		<a href="articles/list.php"><img src="assets/images/icon-articles.png" class="sidebar-icon"> Articles</a>
		<a href="content_types/list.php"><img src="assets/images/icon-categories.png" class="sidebar-icon"> Content Types</a>
		<a href="categories/list.php"><img src="assets/images/icon-categories.png" class="sidebar-icon"> Categories</a>
		<a href="tags/list.php"><img src="assets/images/icon-categories.png" class="sidebar-icon"> Tags</a>
		<a href="pages/list.php"><img src="assets/images/icon-pages.png" class="sidebar-icon"> Pages</a>
		<a href="authors/list.php"><img src="assets/images/icon-authors.png" class="sidebar-icon"> Authors</a>
		<a href="books/list.php"><img src="assets/images/icon-books.png" class="sidebar-icon"> Books</a>
		<a href="photo_gallery/list.php"><img src="assets/images/icon-photo-gallery.png" class="sidebar-icon"> Photo Gallery</a>
		<a href="youtube_gallery/list.php"><img src="assets/images/icon-youtube-gallery.png" class="sidebar-icon"> YouTube Gallery</a>
		<!-- <a href="products/list.php"><img src="assets/images/icon-products.png" class="sidebar-icon"> Products</a> -->
		<a href="blocks/list.php"><img src="assets/images/icon-blocks.png" class="sidebar-icon"> Blocks</a>
		<a href="users/list.php"><img src="assets/images/icon-users.png" class="sidebar-icon"> Users</a>
		<a href="media_library/list.php"><img src="assets/images/icon-media-library.png" class="sidebar-icon"> Media Library</a>
		<a href="settings/list.php"><img src="assets/images/icon-settings.png" class="sidebar-icon"> Settings</a>
		<a href="users/logout.php"><img src="assets/images/icon-logout.png" class="sidebar-icon"> Logout</a>
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
			<div class="metric-box">📚 Content Types<br><span><?= $totalContentTypes ?></span></div>
			<div class="metric-box">📚 Categories<br><span><?= $totalCategories ?></span></div>
			<div class="metric-box">📚 Tags<br><span><?= $totalTags ?></span></div>
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
				<h3>🕒 Recent Content Types</h3>
				<ul>
				<?php foreach ($recentContentTypes as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
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
				<h3>🕒 Recent Tags</h3>
				<ul>
				<?php foreach ($recentTags as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
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
	</div>
</div>

<footer>
	Powered by Copilot &mdash; Built with clarity, collaboration, and care.
</footer>

</body>
</html>
