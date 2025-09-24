<?php
function startLayout($title = "Admin Panel") {
  echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <title>$title</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/scripts.js"></script>
</head>
<body>
<div class="container">
  <div class="sidebar">
    <h3>Admin</h3>
    <a href="../articles/list.php">📰 Articles</a>
    <a href="../pages/list.php">📄 Pages</a>
    <a href="../categories/list.php">🗂️ Categories</a>
    <a href="../main_menu/list.php">📑 Main Menu</a>
    <a href="../authors/list.php">👤 Authors</a>
	<a href="../books/list.php">📰 Books</a>
    <a href="../blocks/list.php">🧱 Blocks</a>
    <a href="../settings/view.php">⚙️ Settings</a>
  </div>
  <div class="main">
HTML;
}

function endLayout() {
  echo <<<HTML
  </div>
</div>
</body>
</html>
HTML;
}
?>
