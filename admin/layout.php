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
		<a href="../index.php"><span>📊</span> Dashboard</a>
		<a href="../main_menu/list.php"><span>🧭</span> Main Menu</a>
		<a href="../articles/list.php"><span>📰</span> Articles</a>
		<a href="../pages/list.php"><span>📄</span> Pages</a>
		<a href="../categories/list.php"><span>🗂️</span> Categories</a>
		<a href="../authors/list.php"><span>👤</span> Authors</a>
		<a href="../books/list.php"><span>📖</span> Books</a>
		<a href="../photo_gallery/list.php"><span>🖼️</span> Photo Gallery</a>
		<a href="../youtube_gallery/list.php"><span>📺</span> YouTube Gallery</a>
		<a href="../products/list.php"><span>📦</span> Products</a>
		<a href="../blocks/list.php"><span>🧱</span> Blocks</a>
		<a href="../users/list.php"><span>👥</span> Users</a>
		<a href="../media_library/list.php"><span>🎞️</span> Media Library</a>
		<a href="../settings/list.php"><span>⚙️</span> Settings</a>
		<a href="../users/logout.php"><span>🚪</span> Logout</a>
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
			Powered by Copilot &mdash; Built with clarity, collaboration, and care. &copy; ' . date('Y') . ' CopilotCMS.
		</footer>
		</body>
		</html>
	');
}
?>
