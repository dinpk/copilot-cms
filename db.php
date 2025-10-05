
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'simplesite';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// util functions




function isUrlTaken($slug, $excludeTable = '', $excludeKey = 0) {
  global $conn;

  $tables = [
    'articles' => 'key_articles',
    'pages' => 'key_pages',
    'categories' => 'key_categories',
    'books' => 'key_books',
    'products' => 'key_product',
    'authors' => 'key_authors',
    'photo_gallery' => 'key_photo_gallery',
    'youtube_gallery' => 'key_youtube_gallery',
    'blocks' => 'key_blocks',
    'main_menu' => 'key_main_menu',
    'book_categories' => 'key_book_categories',
    'product_categories' => 'key_product_categories',
    'photo_categories' => 'key_photo_categories',
    'youtube_categories' => 'key_youtube_categories',
    'users' => 'key_user'
  ];

  foreach ($tables as $table => $keyField) {
    if ($table === $excludeTable) continue;

    $stmt = $conn->prepare("SELECT COUNT(*) FROM $table WHERE url = ?" . ($excludeKey ? " AND $keyField != ?" : ""));
    if ($excludeKey) {
      $stmt->bind_param("si", $slug, $excludeKey);
    } else {
      $stmt->bind_param("s", $slug);
    }

    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) return true;
  }

  return false;
}





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




?>
