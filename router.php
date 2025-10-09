<?php 


$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $path);
$slug = $segments[1] ?? '';


switch ($segments[0]) {
	case '':
	case 'home':
		include 'templates/default/homepage.php';
		break;
	case 'articles':
		$_GET['slug'] = $slug;
		include 'templates/default/articles.php';
		break;
	case 'category':
	case 'article':
		$_GET['slug'] = $slug;
		include 'templates/default/article.php';
		break;
	case 'category':
		$_GET['slug'] = $slug;
		include 'templates/default/category.php';
		break;
	case 'book':
		$_GET['slug'] = $slug;
		include 'templates/default/book.php';
		break;
	case 'page':
		$_GET['slug'] = $slug;
		include 'templates/default/page.php';
		break;
	case 'author':
	  $_GET['slug'] = $slug;
	  include 'templates/default/author.php';
	  break;
	case 'youtube_gallery':
	  include 'templates/default/youtube_gallery.php';
	  break;
	case 'photo_gallery':
	  include 'templates/default/photo_gallery.php';
	  break;
	case 'search':
	  $_GET['q'] = $_GET['q'] ?? '';
	  include 'templates/default/search.php';
	  break;

	// Add more cases as needed
	default:
		echo "404 - Page not found";
}
?>