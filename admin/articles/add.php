<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'articles')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$is_featured = isset($_POST['is_featured']) ? '1' : '0';
	$show_on_home = isset($_POST['show_on_home']) ? '1' : '0';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	articles (title, title_sub, article_snippet, article_content, book_indent_level, url, banner_image_url, sort, is_active, is_featured, show_on_home, created_by, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('ssssissisiiii',
	$_POST['title'],
	$_POST['title_sub'],
	$_POST['article_snippet'],
	$_POST['article_content'],
	$_POST['book_indent_level'],
	$_POST['url'],
	$_POST['banner_image_url'],
	$_POST['sort'],
	$_POST['is_active'],
	$is_featured,
	$show_on_home,
	$createdBy,
	$_POST['key_media_banner']
	);
	$stmt->execute();
	
	$newRecordId = $conn->insert_id;

	if (!empty($_POST['content_types'])) {
		$stmtCont = $conn->prepare('INSERT IGNORE INTO article_content_types (key_articles, key_content_types) VALUES (?, ?)');
		foreach ($_POST['content_types'] as $contId) {
			$stmtCont->bind_param('ii', $newRecordId, $contId);
			$stmtCont->execute();
		}
	}
	
	if (!empty($_POST['tags'])) {
		$stmtCont = $conn->prepare('INSERT IGNORE INTO article_tags (key_articles, key_tags) VALUES (?, ?)');
		foreach ($_POST['tags'] as $contId) {
			$stmtCont->bind_param('ii', $newRecordId, $contId);
			$stmtCont->execute();
		}
	}
	
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO article_categories (key_articles, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $newRecordId, $catId);
			$stmtCat->execute();
		}
	}

}
?>