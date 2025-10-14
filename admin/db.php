<?php

/*
// direct access denied
if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    http_response_code(403);
    exit('Access denied.');
}
*/

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


// ------------ util functions



// db.php
$settings = [];
$sql = "SELECT setting_key, setting_value FROM settings WHERE is_active = 1";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

function getSetting($key, $default = null) {
    global $settings;
    return $settings[$key] ?? $default;
}

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






function sortLink($label, $column, $currentSort, $currentDir) {
    $newDir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';
    $icon = '';

    if ($currentSort === $column) {
        $icon = $currentDir === 'asc' ? ' 🠉' : ' 🠋';
    }

    $query = $_GET;
    $query['sort'] = $column;
    $query['dir'] = $newDir;
    $url = '?' . http_build_query($query);

    return "<a href=\"$url\">$label$icon</a>";
}




?>
