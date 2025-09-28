<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



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
	<a href="../books/books_sell.php">📰 Books Sell</a>
	<a href="../photo_gallery/list.php">📰 Photo Gallery</a>
	<a href="../youtube_gallery/list.php">📰 Youtube Gallery</a>
    <a href="../blocks/list.php">🧱 Blocks</a>
    <a href="../settings/view.php">⚙️ Settings</a>
  </div>
  
  
  
	<div id="info-modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%);
	  background:#fff; padding:20px; border:1px solid #ccc; box-shadow:0 0 10px rgba(0,0,0,0.2); width:600px; z-index:1000;">
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
</body>
</html>
HTML;
}


// Non-layout functions


function sortLink($label, $column, $currentSort, $currentDir) {
    $newDir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';
    $icon = '';

    if ($currentSort === $column) {
        $icon = $currentDir === 'asc' ? ' 🔼' : ' 🔽';
    }

    $query = $_GET;
    $query['sort'] = $column;
    $query['dir'] = $newDir;
    $url = '?' . http_build_query($query);

    return "<a href=\"$url\">$label$icon</a>";
}

function renderCategoryCheckboxes($conn, $selected = []) {
  $res = $conn->query("SELECT key_categories, name FROM categories ORDER BY sort");
  if (!$res) {
    echo "<p style='color:red;'>Failed to load categories.</p>";
    return;
  }

  while ($cat = $res->fetch_assoc()) {
    $key = $cat['key_categories'];
    $name = htmlspecialchars($cat['name']);
    $checked = in_array($key, $selected) ? 'checked' : '';
    echo "<label><input type='checkbox' name='categories[]' value='$key' $checked> $name</label><br>";
  }
}


?>
