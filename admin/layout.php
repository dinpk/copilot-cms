<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function startLayout($title = "Admin Panel") {
  echo <<<HTML
<!DOCTYPE html>
<html>
<div id="code-message"><span id="code-message-x" onclick="closeMessage();">X</span></div>

<head>
  <title>$title</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/scripts.js"></script>
</head>
<body>
<header>
$title
</header>
<div class="container">
	<div class="sidebar">
	  <h3>Admin</h3>
	  <a href="../index.php">📊 Dashboard</a>
	  <a href="../main_menu/list.php">🧭 Main Menu</a>
	  <a href="../articles/list.php">📝 Articles</a>
	  <a href="../pages/list.php">📘 Pages</a>
	  <a href="../categories/list.php">🏷️ Categories</a>
	  <a href="../authors/list.php">🧑‍ Authors</a>
	  <a href="../books/list.php">📚 Books</a>
	  <a href="../photo_gallery/list.php">🖼️ Photo Gallery</a>
	  <a href="../youtube_gallery/list.php">🎥 YouTube Gallery</a>
	  <a href="../products/list.php">🛍️ Products</a>
	  <a href="../blocks/list.php">🧩 Blocks</a>
	  <a href="../users/list.php">👥 Users</a>
	  <a href="../settings/list.php">🛠️ Settings</a>
	  <a href="../users/logout.php">🚪 Logout</a>
	</div>

  
  
  
	<div id="info-modal" class="modal">
	  <h3 id="info-modal-title">Info</h3>
	  <div id="info-modal-content" style="max-height:400px; overflow-y:auto;"></div>
	  <p><button type="button" onclick="closeInfoModal()">Close</button></p>
	</div>
  
  
  
  <div class="main">
HTML;
}

function endLayout() {
	
	
  echo <<<HTML
  </div>
</div>



<footer>
  Powered by Copilot &mdash; Built with clarity, collaboration, and care. &copy; <?= date('Y') ?> CopilotCMS. All rights reserved.
</footer>

</body>
</html>
HTML;
}



?>
