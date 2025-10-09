
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

function firstWords($text, $limit = 15) {
  return implode(' ', array_slice(explode(' ', strip_tags($text)), 0, $limit));
}


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
    'book_categories' => 'key_book_categories',
    'product_categories' => 'key_product_categories',
    'photo_categories' => 'key_photo_categories',
    'youtube_categories' => 'key_youtube_categories',
    'users' => 'key_user'
  ];

  $slugEscaped = $conn->real_escape_string($slug);

  foreach ($tables as $table => $keyField) {
    $query = "SELECT COUNT(*) AS total FROM `$table` WHERE url = '$slugEscaped'";

    if ($table === $excludeTable && $excludeKey) {
      $query .= " AND `$keyField` != " . intval($excludeKey);
    }

    $result = $conn->query($query);
    if ($result) {
      $row = $result->fetch_assoc();
      if ($row['total'] > 0) {
        return true;
      }
    }
  }

  return false;
}


/*
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
    'book_categories' => 'key_book_categories',
    'product_categories' => 'key_product_categories',
    'photo_categories' => 'key_photo_categories',
    'youtube_categories' => 'key_youtube_categories',
    'users' => 'key_user'
  ];

  foreach ($tables as $table => $keyField) {
    $query = "SELECT COUNT(*) FROM $table WHERE url = ?";
    $types = "s";
    $params = [$slug];

    if ($table === $excludeTable && $excludeKey) {
      $query .= " AND $keyField != ?";
      $types .= "i";
      $params[] = $excludeKey;
    }

    $stmt = $conn->prepare($query);
    if (!$stmt) {
      continue; // Skip if prepare fails
    }

    // Bind parameters safely using references
    $bindParams = [];
    $bindParams[] = $types;
    foreach ($params as $key => $value) {
      $bindParams[] = &$params[$key];
    }

    call_user_func_array([$stmt, 'bind_param'], $bindParams);

    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) return true;
  }

  return false;
}
*/






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
