<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('viewer' == $_SESSION['role']) {
	 echo "'⚠ You do not have access to edit a record';";
	 exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	if (isUrlTaken($_POST['url'], 'articles', $id)) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$is_featured = isset($_POST['is_featured']) ? '1' : '0';
	$show_on_home = isset($_POST['show_on_home']) ? '1' : '0';
	$updatedBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	UPDATE articles 
	SET	title = ?, title_sub = ?, article_snippet = ?, article_content = ?, url = ?, book_indent_level = ?, banner_image_url = ?, sort = ?, 
	is_active = ?, is_featured = ?, show_on_home = ?, updated_by = ?, key_media_banner = ?
	WHERE key_articles = ?
	');
	$stmt->bind_param('sssssisisiiiii',
	$_POST['title'],
	$_POST['title_sub'],
	$_POST['article_snippet'],
	$_POST['article_content'],
	$_POST['url'],
	$_POST['book_indent_level'],
	$_POST['banner_image_url'],
	$_POST['sort'],
	$_POST['is_active'],
	$is_featured,
	$show_on_home,
	$updatedBy,
	$_POST['key_media_banner'],
	$id
	);
	$stmt->execute();

	$conn->query("DELETE FROM article_categories WHERE key_articles = $id");
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO article_categories (key_articles, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
				$stmtCat->bind_param('ii', $id, $catId);
				$stmtCat->execute();
		}
	}

	$conn->query("DELETE FROM article_content_types WHERE key_articles = $id");
	if (!empty($_POST['content_types'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO article_content_types (key_articles, key_content_types) VALUES (?, ?)');
		foreach ($_POST['content_types'] as $contId) {
				$stmtCat->bind_param('ii', $id, $contId);
				$stmtCat->execute();
		}
	}

	$conn->query("DELETE FROM article_tags WHERE key_articles = $id");
	if (!empty($_POST['tags'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO article_tags (key_articles, key_tags) VALUES (?, ?)');
		foreach ($_POST['tags'] as $tagId) {
				$stmtCat->bind_param('ii', $id, $tagId);
				$stmtCat->execute();
		}
	}

}
?>