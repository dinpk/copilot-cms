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
$totalHomeSections = getCount("home_page_sections");
$totalMainMenu = getCount("main_menu");
$totalArticles = getCount("articles");
$totalPages = getCount("pages");
$totalVideos = getCount("youtube_gallery");
$totalPhotos = getCount("photo_gallery");
$totalBooks = getCount("books");
$totalContentTypes = getCount("content_types");
$totalCategories = getCount("categories");
$totalTags = getCount("tags");

$totalAuthors = getCount("authors");
$totalWorkers = getCount("workers");
$totalBlocks = getCount("blocks");

$totalProducts = getCount("products");
$totalOrders = getCount("product_orders");

// Recent Articles
$recentHomeSections = getRecent("home_page_sections", "title", "title", 5);
$recentMainMenu = getRecent("main_menu", "title", "entry_date_time", 5);
$recentArticles = getRecent("articles", "title", "entry_date_time", 5);
$recentBooks = getRecent("books", "title", "entry_date_time", 5);
$recentPages = getRecent("pages", "title", "entry_date_time", 5);
$recentAuthors = getRecent("authors", "name", "entry_date_time", 5);
$recentWorkers = getRecent("workers", "name", "entry_date_time", 5);
$recentProducts = getRecent("products", "title", "entry_date_time", 5);
$recentGallery = getRecent("photo_gallery", "title", "entry_date_time", 5);
$recentYoutube = getRecent("youtube_gallery", "title", "entry_date_time", 5);
$recentContentTypes = getRecent("content_types", "name", "entry_date_time", 5);
$recentCategories = getRecent("categories", "name", "entry_date_time", 5);
$recentTags = getRecent("tags", "name", "entry_date_time", 5);
$recentBlocks = getRecent("blocks", "title", "entry_date_time", 5);
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
		<a href="home_page_sections/list.php"><img src="assets/images/icon-home-sections.png" class="sidebar-icon"> Home Page Sections</a>
		<a href="main_menu/list.php"><img src="assets/images/icon-main-menu.png" class="sidebar-icon"> Main Menu</a>
		<a href="articles/list.php"><img src="assets/images/icon-articles.png" class="sidebar-icon"> Articles</a>
		<a href="content_types/list.php"><img src="assets/images/icon-content-types.png" class="sidebar-icon"> Content Types</a>
		<a href="categories/list.php"><img src="assets/images/icon-categories.png" class="sidebar-icon"> Categories</a>
		<a href="tags/list.php"><img src="assets/images/icon-tags.png" class="sidebar-icon"> Tags</a>
		<a href="pages/list.php"><img src="assets/images/icon-pages.png" class="sidebar-icon"> Pages</a>
		<a href="authors/list.php"><img src="assets/images/icon-authors.png" class="sidebar-icon"> Authors</a>
		<a href="workers/list.php"><img src="assets/images/icon-workers.png" class="sidebar-icon"> Workers</a>
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
		<h2>📊 Overview</h2>
		<div class="dashboard-metrics">
			<div class="metric-box"><img src="assets/images/dash-icon-home-sections.png"><br> Home Sections<br><span><?= $totalHomeSections ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-main-menu.png"><br> Main Menu<br><span><?= $totalMainMenu ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-articles.png"><br> Articles<br><span><?= $totalArticles ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-authors.png"><br> Authors<br><span><?= $totalAuthors ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-workers.png"><br> Workers<br><span><?= $totalWorkers ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-pages.png"><br> Pages<br><span><?= $totalPages ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-videos.png"><br> Videos<br><span><?= $totalVideos ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-photo-galleries.png"><br>Photo Galleries<br><span><?= $totalPhotos ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-books.png"><br> Books<br><span><?= $totalBooks ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-content-types.png"><br> Content Types<br><span><?= $totalContentTypes ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-categories.png"><br> Categories<br><span><?= $totalCategories ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-tags.png"><br> Tags<br><span><?= $totalTags ?></span></div>
			<div class="metric-box"><img src="assets/images/dash-icon-blocks.png"><br> Blocks<br><span><?= $totalBlocks ?></span></div>
			<div class="metric-box" style="display:none;"><img src="assets/images/dash-icon-products.png"><br> Products<br><span><?= $totalProducts ?></span></div>
			<div class="metric-box" style="display:none;"><img src="assets/images/dash-icon-orders.png"><br> Orders<br><span><?= $totalOrders ?></span></div>
		</div>
		<div class="recents">
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-articles.png"> Recent Articles</h3>
				<ul>
				<?php foreach ($recentArticles as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= $item['entry_date_time'] ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-home-sections.png">  Recent Home Sections</h3>
				<ul>
				<?php foreach ($recentHomeSections as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= $item['title'] ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-main-menu.png">  Recent Main Menu</h3>
				<ul>
				<?php foreach ($recentMainMenu as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= $item['entry_date_time'] ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-content-types.png">  Recent Content Types</h3>
				<ul>
				<?php foreach ($recentContentTypes as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-categories.png">  Recent Categories</h3>
				<ul>
				<?php foreach ($recentCategories as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-tags.png">  Recent Tags</h3>
				<ul>
				<?php foreach ($recentTags as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-pages.png">  Recent Pages</h3>
				<ul>
				<?php foreach ($recentPages as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-authors.png">  Recent Authors</h3>
				<ul>
				<?php foreach ($recentAuthors as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-workers.png">  Recent Workers</h3>
				<ul>
				<?php foreach ($recentWorkers as $item): ?>
					<li><?= htmlspecialchars($item['name']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-books.png">  Recent Books</h3>
				<ul>
				<?php foreach ($recentBooks as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity" style="display:none;">
				<h3><img src="assets/images/dash-icon-products.png">  Recent Products</h3>
				<ul>
				<?php foreach ($recentProducts	as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-videos.png">  Recent Youtube</h3>
				<ul>
				<?php foreach ($recentYoutube as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-photo-galleries.png">  Recent Photo Gallery</h3>
				<ul>
				<?php foreach ($recentGallery as $item): ?>
					<li><?= htmlspecialchars($item['title']) ?><br> <small><?= date_format(date_create($item["entry_date_time"]), "d M, Y - H:i a") ?></small></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="recent-activity">
				<h3><img src="assets/images/dash-icon-blocks.png">  Recent Blocks</h3>
				<ul>
				<?php foreach ($recentBlocks as $item): ?>
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
