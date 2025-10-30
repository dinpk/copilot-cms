<?php 

include_once 'templates/settings.php';
function getSetting($key, $default = null) {
	global $settings;
	return $settings[$key] ?? $default;
}
$template = getSetting('template_folder', 'default');



$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $path);
$slug = $segments[1] ?? '';


switch ($segments[0]) {
	case '':
	case 'home':
		include("templates/$template/homepage.php");
		break;
	case 'articles':
		$_GET['slug'] = $slug;
		include("templates/$template/articles.php");
		break;
	case 'article':
		$_GET['slug'] = $slug;
		include("templates/$template/article.php");
		break;
	case 'categories':
		$_GET['slug'] = $slug;
		include("templates/$template/categories.php");
		break;
	case 'category':
		$_GET['slug'] = $slug;
		include("templates/$template/category.php");
		break;
	case 'books':
		$_GET['slug'] = $slug;
		include("templates/$template/books.php");
		break;
	case 'book':
		$_GET['slug'] = $slug;
		include("templates/$template/book.php");
		break;
	case 'pages':
		$_GET['slug'] = $slug;
		include("templates/$template/pages.php");
		break;
	case 'page':
		$_GET['slug'] = $slug;
		include("templates/$template/page.php");
		break;
	case 'authors':
	  $_GET['slug'] = $slug;
	  include("templates/$template/authors.php");
	  break;
	case 'author':
	  $_GET['slug'] = $slug;
	  include("templates/$template/author.php");
	  break;
	case 'youtube-gallery':
	  include("templates/$template/youtube_gallery.php");
	  break;
	case 'photo-gallery':
	  include("templates/$template/photo_gallery.php");
	  break;
	case 'search':
	  $_GET['q'] = $_GET['q'] ?? '';
	  include("templates/$template/search.php");
	  break;
	default:
		echo "404 - Page not found";
}
?>