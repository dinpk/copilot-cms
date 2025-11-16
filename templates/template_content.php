<?php

function getPagination($totalItems, $currentPage = 1, $perPage = 10, $baseUrl = '?page=') {
	$totalPages = max(1, ceil($totalItems / $perPage));
	$currentPage = max(1, min($currentPage, $totalPages));
	$offset = ($currentPage - 1) * $perPage;

	$hasPrev = $currentPage > 1;
	$hasNext = $currentPage < $totalPages;
	$prevPage = $currentPage - 1;
	$nextPage = $currentPage + 1;

	// Generate HTML
	$html = "<div id='pager'>";
	if ($hasPrev) {
		$html .= "<a href='{$baseUrl}{$prevPage}'>" . getSetting('pager_prev_label') . "</a> ";
	}
	$html .= "Page {$currentPage} of {$totalPages} ";
	if ($hasNext) {
		$html .= "<a href='{$baseUrl}{$nextPage}'>" . getSetting('pager_next_label') . "</a>";
	}
	$html .= "</div>";

	return [
		'limit' => $perPage,
		'offset' => $offset,
		'current' => $currentPage,
		'total_pages' => $totalPages,
		'has_prev' => $hasPrev,
		'has_next' => $hasNext,
		'prev_page' => $prevPage,
		'next_page' => $nextPage,
		'html' => $html
	];
}




/* --------------------- HOMEPAGE / ARTICLES ---------------------- */

function getPaginatedArticles($conn, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM articles WHERE is_active = 1";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT a.*, m.file_url_thumbnail AS banner
			FROM articles a 
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media
			WHERE a.is_active = 1
			ORDER BY entry_date_time DESC
			LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "?page=")
	];
}

function getArticleBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT a.*, m.file_url AS banner_url
			FROM articles a
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media
			WHERE a.url = '$slug' AND a.is_active = 1";
	return $conn->query($sql)->fetch_assoc();
}

function getAuthorsForArticle($conn, $key) {
	$sql = "SELECT name, url FROM authors
			JOIN article_authors ON authors.key_authors = article_authors.key_authors
			WHERE article_authors.key_articles = $key";
	return $conn->query($sql);
}

function getCategoriesForArticle($conn, $key) {
	$sql = "SELECT name, categories.url FROM categories
			JOIN article_categories ON categories.key_categories = article_categories.key_categories
			WHERE article_categories.key_articles = $key";
	return $conn->query($sql);
}

/* --------------------- AUTHORS ---------------------- */

function getPaginatedAuthors($conn, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM authors WHERE is_active = 1";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT authors.*, m.file_url_thumbnail AS banner FROM authors 
			LEFT JOIN media_library m ON authors.key_media_banner = m.key_media 
			WHERE authors.is_active = 1 ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "?page=")
	];
}

function getAuthorBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT authors.*, m.file_url AS banner_url FROM authors 
			LEFT JOIN media_library m ON authors.key_media_banner = m.key_media 
			WHERE authors.url = '$slug'";
	return $conn->query($sql)->fetch_assoc();
}

function getArticlesForAuthor($conn, $key) {
	$sql = "SELECT a.title, a.article_snippet, a.url, m.file_url AS banner 
			FROM articles a 
			JOIN article_authors aa ON a.key_articles = aa.key_articles 
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
			WHERE aa.key_authors = $key AND a.is_active = 1 
			ORDER BY a.sort";
	return $conn->query($sql);
}

/* --------------------- BOOKS ---------------------- */

function getPaginatedBooks($conn, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM books WHERE is_active = 1";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT books.*, m.file_url_thumbnail AS banner_url FROM books 
			LEFT JOIN media_library m ON books.key_media_banner = m.key_media 
			ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "?page=")
	];
}

function getBookBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT b.*, m.file_url AS banner_url 
			FROM books b 
			LEFT JOIN media_library m ON b.key_media_banner = m.key_media 
			WHERE b.url = '$slug' AND b.is_active = 1";
	return $conn->query($sql)->fetch_assoc();
}

function getArticlesForBook($conn, $key) {
	$sql = "SELECT a.title, a.url, a.book_indent_level, m.file_url AS banner 
			FROM articles a 
			JOIN book_articles ba ON a.key_articles = ba.key_articles 
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
			WHERE ba.key_books = $key AND a.is_active = 1 
			ORDER BY a.sort";
	return $conn->query($sql);
}


/* --------------------- CONTENT TYPES ---------------------- */

function getContentTypes($conn) {
	return $conn->query("
		SELECT DISTINCT c.key_content_types, c.name, c.url
		FROM content_types c
		INNER JOIN article_content_types ac ON c.key_content_types = ac.key_content_types
		WHERE c.is_active = 1 
		ORDER BY c.name ASC
	");}


function getContentTypeBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT c.*, m.file_url AS banner_url 
	FROM content_types c 
	LEFT JOIN media_library m ON c.key_media_banner = m.key_media 
	WHERE c.url = '$slug'";
	return $conn->query($sql)->fetch_assoc();
}

function getPaginatedArticlesForContentType($conn, $key, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM articles a 
				JOIN article_content_types ac ON a.key_articles = ac.key_articles 
				WHERE ac.key_content_types = $key AND a.is_active = 1";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT a.*, m.file_url AS banner 
	FROM articles a 
	JOIN article_content_types ac ON a.key_articles = ac.key_articles 
	LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
	WHERE ac.key_content_types = $key AND a.is_active = 1 
	LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "?page=")
	];	

}


/* --------------------- Tags ---------------------- */

function getTags($conn) {
	return $conn->query("
		SELECT DISTINCT t.key_tags, t.name, t.url
		FROM tags t
		INNER JOIN article_tags ac ON t.key_tags = ac.key_tags
		WHERE t.is_active = 1 
		ORDER BY t.name ASC
	");}


function getTagBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT t.*, m.file_url AS banner_url 
	FROM tags t 
	LEFT JOIN media_library m ON t.key_media_banner = m.key_media 
	WHERE t.url = '$slug'";
	return $conn->query($sql)->fetch_assoc();
}

function getPaginatedArticlesForTag($conn, $key, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM articles a 
				JOIN article_tags ac ON a.key_articles = ac.key_articles 
				WHERE ac.key_tags = $key AND a.is_active = 1";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT a.*, m.file_url AS banner 
	FROM articles a 
	JOIN article_tags ac ON a.key_articles = ac.key_articles 
	LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
	WHERE ac.key_tags = $key AND a.is_active = 1 
	LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "?page=")
	];	

}


/* --------------------- CATEGORIES ---------------------- */

function getCategories($conn) {
	return $conn->query("
		SELECT DISTINCT c.key_categories, c.name, c.url
		FROM categories c
		INNER JOIN article_categories ac ON c.key_categories = ac.key_categories
		WHERE c.is_active = 1 
		ORDER BY c.name ASC
	");
}


function getCategoryBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT c.*, m.file_url AS banner_url 
	FROM categories c 
	LEFT JOIN media_library m ON c.key_media_banner = m.key_media 
	WHERE c.url = '$slug'";
	return $conn->query($sql)->fetch_assoc();
}

function getPaginatedArticlesForCategory($conn, $key, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM articles a 
				JOIN article_categories ac ON a.key_articles = ac.key_articles 
				WHERE ac.key_categories = $key AND a.is_active = 1";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT a.*, m.file_url AS banner 
	FROM articles a 
	JOIN article_categories ac ON a.key_articles = ac.key_articles 
	LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
	WHERE ac.key_categories = $key AND a.is_active = 1 
	LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "?page=")
	];	

}


/* --------------------- PAGES ---------------------- */



function getPaginatedPages($conn, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM pages WHERE is_active = 1";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT pages.*, m.file_url_thumbnail AS banner FROM pages 
		  LEFT JOIN media_library m ON pages.key_media_banner = m.key_media 
		  WHERE pages.is_active = 1 ORDER BY sort ASC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "?page=")
	];
}

function getPageBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT p.*, m.file_url AS banner_url 
			FROM pages p 
			LEFT JOIN media_library m ON p.key_media_banner = m.key_media 
			WHERE p.url = '$slug' AND p.is_active = 1";
	return $conn->query($sql)->fetch_assoc();
}


/* --------------------- MAIN MENU ---------------------- */


function getMenuItems() {
    global $conn;
    $items = [];
    $res = $conn->query("SELECT key_main_menu, parent_id, title, url_link FROM main_menu WHERE is_active = 1 ORDER BY sort");
    while ($row = $res->fetch_assoc()) {
        $items[$row['parent_id']][] = $row;
    }
    return $items;
}
function renderMenuTree($items, $parent_id = 0) {
    if (!isset($items[$parent_id])) return;

    echo "<ul>";
    foreach ($items[$parent_id] as $item) {
        echo "<li><a href='" . htmlspecialchars($item['url_link']) . "'>" . htmlspecialchars($item['title']) . "</a>";
        renderMenuTree($items, $item['key_main_menu']); // Recursion for children
        echo "</li>";
    }
    echo "</ul>";
}
function renderMainMenu() {
    $items = getMenuItems();
	
	echo "<button class='menu-toggle' onclick=\"document.querySelector('.main-menu').classList.toggle('open')\">☰ Menu</button>";
	
    echo "<nav class='main-menu'>";
    renderMenuTree($items);
    echo "</nav>";
}


/* --------------------- RENDER BLOCKS ---------------------- */


function renderBlocks($region, $currentPage = '') {
	global $conn;
	$sql = "SELECT key_blocks, key_photo_gallery, title, block_content, module_file, visible_on FROM blocks 
					   WHERE is_active = 1  
					   AND show_in_region = '$region' 
					   AND (show_on_pages = '' OR FIND_IN_SET('$currentPage', show_on_pages)) 
					   ORDER BY sort";
	$res = $conn->query($sql);
	// echo __FILE__;
	while ($row = $res->fetch_assoc()) {
		$devices_array = explode(',', $row['visible_on']);
		$visibilityClasses = '';
		foreach ($devices_array as $device) $visibilityClasses .= ' visible-on-' . $device;
		$key_photo_gallery = $row['key_photo_gallery'];
		echo "<div class='block $visibilityClasses'>";
		echo "<h2>" . $row['title'] . "</h2>";
		echo "<div class='block-content'>" .  $row['block_content'] . "</div>";
		if ($row['module_file'] != '') {
			include("modules/" . $row['module_file'] . ".php");
		}
		echo "</div>";
	}
}


/* --------------------- BREADCRUMB ---------------------- */

function generateBreadcrumb($segments) {
    $breadcrumbs = [];
    $baseUrl = '/'; // Adjust if your site is in a subdirectory

    // Home link
    $breadcrumbs[] = ['label' => 'Home', 'url' => $baseUrl];

    // Map of static labels
    $labels = [
        'articles' => 'Articles',
        'article' => 'Article',
        'content-types' => 'Content Types',
        'content-type' => 'Content Type',
        'categories' => 'Categories',
        'category' => 'Category',
        'tags' => 'Tags',
        'tag' => 'Tag',
        'books' => 'Books',
        'book' => 'Book',
        'pages' => 'Pages',
        'page' => 'Page',
        'authors' => 'Authors',
        'author' => 'Author',
        'youtube-gallery' => 'YouTube Gallery',
        'photo-gallery' => 'Photo Gallery',
        'search' => 'Search Results'
    ];


	$listingMap = [
		'article' => 'articles',
		'book' => 'books',
		'author' => 'authors',
		'category' => 'categories',
		'content-type' => 'content-types',
		'tag' => 'tags',
		'page' => 'pages'
	];

	if (isset($listingMap[$segments[0]])) {
		$listingRoute = $listingMap[$segments[0]];
		$label = str_replace("-", " ", $listingRoute);
		$breadcrumbs[] = [
			'label' => ucwords($label),
			'url' => $baseUrl . $listingRoute
		];
	} else if (!empty($segments[0]) && isset($labels[$segments[0]])) {
        $breadcrumbs[] = [
            'label' => $labels[$segments[0]],
            'url' => $baseUrl . $segments[0]
        ];
    }

    // Second segment (slug)
    if (!empty($segments[1])) {
        $label = ucwords(str_replace('-', ' ', $segments[1]));

        // Optional: fetch title from DB for specific routes
        if (in_array($segments[0], ['article', 'book', 'author', 'category', 'content_type', 'tag', 'page'])) {
            $label = fetchTitleBySlug($segments[0], $segments[1]) ?? $label;
        }

        $breadcrumbs[] = [
            'label' => $label,
            'url' => $baseUrl . $segments[0] . '/' . $segments[1]
        ];
    }

    return $breadcrumbs;
}


function fetchTitleBySlug($type, $slug) {
	global $conn;
    $tableMap = [
        'article' => ['table' => 'articles', 'field' => 'title'],
        'book' => ['table' => 'books', 'field' => 'title'],
        'author' => ['table' => 'authors', 'field' => 'name'],
        'category' => ['table' => 'categories', 'field' => 'name'],
        'content_type' => ['table' => 'content_types', 'field' => 'name'],
        'tag' => ['table' => 'tags', 'field' => 'name'],
        'page' => ['table' => 'pages', 'field' => 'title']
    ];

    if (!isset($tableMap[$type])) return null;

    $table = $tableMap[$type]['table'];
    $field = $tableMap[$type]['field'];

    $stmt = $conn->prepare("SELECT `$field` FROM `$table` WHERE url = ? LIMIT 1");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row[$field];
    }

    return null;
}


/* --------------------- MISC ---------------------- */


function firstWords($text, $limit = 15) {
	return implode(' ', array_slice(explode(' ', strip_tags($text)), 0, $limit));
}





?>