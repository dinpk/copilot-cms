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
		$html .= "<a href='{$baseUrl}{$prevPage}'>⬅ Prev</a> ";
	}
	$html .= "Page {$currentPage} of {$totalPages} ";
	if ($hasNext) {
		$html .= "<a href='{$baseUrl}{$nextPage}'>Next ➡</a>";
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

/* --------------------- ARTICLES ---------------------- */

function getPaginatedArticles($conn, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM articles WHERE status = 'on'";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT a.*, m.file_url_thumbnail AS banner
			FROM articles a 
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media
			WHERE a.status='on'
			ORDER BY entry_date_time DESC
			LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "articles?page=")
	];
}

function getArticleBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT a.*, m.file_url AS banner_url
			FROM articles a
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media
			WHERE a.url = '$slug' AND a.status = 'on'";
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

	$countSql = "SELECT COUNT(*) AS total FROM authors WHERE status = 'on'";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT authors.*, m.file_url_thumbnail AS banner FROM authors 
			LEFT JOIN media_library m ON authors.key_media_banner = m.key_media 
			WHERE authors.status='on' ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "authors?page=")
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
			WHERE aa.key_authors = $key AND a.status = 'on' 
			ORDER BY a.sort";
	return $conn->query($sql);
}

/* --------------------- BOOKS ---------------------- */

function getPaginatedBooks($conn, $page = 1, $limit = 10) {
	$offset = ($page - 1) * $limit;

	$countSql = "SELECT COUNT(*) AS total FROM books WHERE status = 'on'";
	$total = $conn->query($countSql)->fetch_assoc()['total'];

	$sql = "SELECT books.*, m.file_url_thumbnail AS banner_url FROM books 
			LEFT JOIN media_library m ON books.key_media_banner = m.key_media 
			ORDER BY entry_date_time DESC LIMIT $limit OFFSET $offset";
	$records = $conn->query($sql);

	return [
		'records' => $records,
		'pagination' => getPagination($total, $page, $limit, "books?page=")
	];
}

function getBookBySlug($conn, $slug) {
	$slug = $conn->real_escape_string($slug);
	$sql = "SELECT b.*, m.file_url AS banner_url 
			FROM books b 
			LEFT JOIN media_library m ON b.key_media_banner = m.key_media 
			WHERE b.url = '$slug' AND b.status = 'on'";
	return $conn->query($sql)->fetch_assoc();
}

function getArticlesForBook($conn, $key) {
	$sql = "SELECT a.title, a.url, a.book_indent_level, m.file_url AS banner 
			FROM articles a 
			JOIN book_articles ba ON a.key_articles = ba.key_articles 
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media 
			WHERE ba.key_books = $key AND a.status = 'on' 
			ORDER BY a.sort";
	return $conn->query($sql);
}

?>