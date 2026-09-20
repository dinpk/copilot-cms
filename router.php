<?php 

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $path);
$slug = $segments[1] ?? '';
$_GET['slug'] = $slug;

if (empty($segments[0])) {
	$segments[0] = 'home';
	$_SERVER['REQUEST_URI'] = '/home';
}

$template = getSetting('template_folder', 'default');

switch ($segments[0]) {
	case 'home':
		include("templates/$template/homepage.php");
		break;
	case 'articles':
		include("templates/$template/articles.php");
		break;
	case 'article':
		include("templates/$template/article.php");
		break;
	case 'content-types':
		include("templates/$template/content_types.php");
		break;
	case 'content-type':
		include("templates/$template/content_type.php");
		break;
	case 'tags':
		include("templates/$template/tags.php");
		break;
	case 'tag':
		include("templates/$template/tag.php");
		break;
	case 'categories':
		include("templates/$template/categories.php");
		break;
	case 'category':
		include("templates/$template/category.php");
		break;
	case 'books':
		include("templates/$template/books.php");
		break;
	case 'book':
		include("templates/$template/book.php");
		break;
	case 'pages':
		include("templates/$template/pages.php");
		break;
	case 'page':
		include("templates/$template/page.php");
		break;
	case 'authors':
	  include("templates/$template/authors.php");
	  break;
	case 'author':
	  include("templates/$template/author.php");
	  break;
	case 'workers':
	  include("templates/$template/workers.php");
	  break;
	case 'worker':
	  include("templates/$template/worker.php");
	  break;
	case 'youtube-gallery':
	  include("templates/$template/youtube_gallery.php");
	  break;
	case 'photo-gallery':
	  include("templates/$template/photo_gallery.php");
	  break;
	case 'monthly':
		include("templates/$template/monthly.php");
		break;
	case 'monthly-articles':
		include("templates/$template/monthly-articles.php");
		break;
	case 'search':
	  $_GET['q'] = $_GET['q'] ?? '';
	  include("templates/$template/search.php");
	  break;
	default:
		echo "404 - Page not found";
		echo $segments[0];
}
?>