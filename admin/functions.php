<?php

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
	http_response_code(403);
	exit('Direct access denied.');
}



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


function isUrlTaken($slug, $excludeTable = '', $excludeKey = 0) {
  global $conn;

  $tables = [
	'articles' => 'key_articles',
	'pages' => 'key_pages',
	'categories' => 'key_categories',
	'content_types' => 'key_content_types',
	'books' => 'key_books',
	'products' => 'key_product',
	'authors' => 'key_authors',
	'photo_gallery' => 'key_photo_gallery',
	'youtube_gallery' => 'key_youtube_gallery',
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


function resizeImage($sourcePath, $targetPath, $maxWidth, $maxHeight) {
  list($width, $height, $type) = getimagesize($sourcePath);

  // Skip if already within limits
  if ($width <= $maxWidth && $height <= $maxHeight) {
	return copy($sourcePath, $targetPath); // Just duplicate
  }

  $src = imagecreatefromstring(file_get_contents($sourcePath));
  if (!$src) return false;

  $ratio = min($maxWidth / $width, $maxHeight / $height);
  $newWidth = intval($width * $ratio);
  $newHeight = intval($height * $ratio);

  $dst = imagecreatetruecolor($newWidth, $newHeight);
  imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

  $success = false;
  switch ($type) {
	case IMAGETYPE_JPEG: $success = imagejpeg($dst, $targetPath, 90); break;
	case IMAGETYPE_PNG: $success = imagepng($dst, $targetPath); break;
	case IMAGETYPE_WEBP: $success = imagewebp($dst, $targetPath); break;
  }

  imagedestroy($src);
  imagedestroy($dst);
  return $success;
}


function cleanUtf8($data) {
  if (is_array($data)) {
	foreach ($data as $key => $value) {
	  $data[$key] = cleanUtf8($value);
	}
	return $data;
  } elseif (is_string($data)) {
	return mb_convert_encoding($data, 'UTF-8', 'UTF-8');
  } else {
	return $data;
  }
}

function firstWords($text, $limit = 15) {
	return implode(' ', array_slice(explode(' ', strip_tags($text)), 0, $limit));
}


?>
