<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function startLayout($title = "Admin Panel") {
	$username = $_SESSION["username"];
	echo ('
	<!DOCTYPE html>
	<html>
	<div id="code-message"><span id="code-message-x" onclick="closeMessage();">X</span></div>
	<head>
		<title>' . $title . '</title>
		<link rel="stylesheet" href="../assets/css/style.css">
		<script src="../assets/js/scripts.js"></script>
	</head>
	<body>
	<header>' . 
	$title
	. '</header>
	<div class="container">
		<div class="sidebar">
		<h3>' . $username. '</h3>
		<a href="../index.php"><img src="../assets/images/icon-dashboard.png" class="sidebar-icon"> Dashboard</a>
		<a href="../main_menu/list.php"><img src="../assets/images/icon-main-menu.png" class="sidebar-icon"> Main Menu</a>
		<a href="../articles/list.php"><img src="../assets/images/icon-articles.png" class="sidebar-icon"> Articles</a>
		<a href="../content_types/list.php"><img src="../assets/images/icon-categories.png" class="sidebar-icon"> Content Types</a>
		<a href="../categories/list.php"><img src="../assets/images/icon-categories.png" class="sidebar-icon"> Categories</a>
		<a href="../tags/list.php"><img src="../assets/images/icon-categories.png" class="sidebar-icon"> Tags</a>
		<a href="../pages/list.php"><img src="../assets/images/icon-pages.png" class="sidebar-icon"> Pages</a>
		<a href="../authors/list.php"><img src="../assets/images/icon-authors.png" class="sidebar-icon"> Authors</a>
		<a href="../books/list.php"><img src="../assets/images/icon-books.png" class="sidebar-icon"> Books</a>
		<a href="../photo_gallery/list.php"><img src="../assets/images/icon-photo-gallery.png" class="sidebar-icon"> Photo Gallery</a>
		<a href="../youtube_gallery/list.php"><img src="../assets/images/icon-youtube-gallery.png" class="sidebar-icon"> YouTube Gallery</a>
		<!-- <a href="../products/list.php"><img src="../assets/images/icon-products.png" class="sidebar-icon"> Products</a> -->
		<a href="../blocks/list.php"><img src="../assets/images/icon-blocks.png" class="sidebar-icon"> Blocks</a>
		<a href="../users/list.php"><img src="../assets/images/icon-users.png" class="sidebar-icon"> Users</a>
		<a href="../media_library/list.php"><img src="../assets/images/icon-media-library.png" class="sidebar-icon"> Media Library</a>
		<a href="../settings/list.php"><img src="../assets/images/icon-settings.png" class="sidebar-icon"> Settings</a>
		<a href="../users/logout.php"><img src="../assets/images/icon-logout.png" class="sidebar-icon"> Logout</a>
		</div>
		
		<div id="info-modal" class="modal">
			<h3 id="info-modal-title">Info</h3>
			<div id="info-modal-content" style="max-height:400px; overflow-y:auto;"></div>
			<p><button type="button" onclick="closeInfoModal()">Close</button></p>
		</div>
		<div class="main">
	');
}

function endLayout() {
	echo ('
		</div> <!-- main -->
		</div> <!-- container -->
		<footer>
			Powered by Copilot &mdash; Built with clarity, collaboration, and care.
		</footer>
		</body>
		</html>
	');
}
?>
