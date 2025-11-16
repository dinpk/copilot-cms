<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	if (isUrlTaken($_POST['url'], 'books')) {
		echo '❌ This URL is already used in another module. Please choose a unique one.';
		exit;
	}
	$isActive = isset($_POST['is_active']) ? '1' : '0';
	$createdBy = $_SESSION['key_user'];
	$stmt = $conn->prepare('
	INSERT INTO 
	books (title, subtitle, description, url, banner_image_url, author_name, publisher, publish_year, isbn, is_featured, language, format, weight_grams, sku, is_active, created_by, key_media_banner) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('sssssssssisssiiii',
		$_POST['title'],
		$_POST['subtitle'],
		$_POST['description'],
		$_POST['url'],
		$_POST['banner_image_url'],
		$_POST['author_name'],
		$_POST['publisher'],
		$_POST['publish_year'],
		$_POST['isbn'],
		$_POST['is_featured'],
		$_POST['language'],
		$_POST['format'],
		$_POST['weight_grams'],
		$_POST['sku'],
		$isActive,
		$createdBy,
		$_POST['key_media_banner']
	);
	$stmt->execute();
	$newRecordId = $conn->insert_id;
	if (!empty($_POST['categories'])) {
		$stmtCat = $conn->prepare('INSERT IGNORE INTO book_categories (key_books, key_categories) VALUES (?, ?)');
		foreach ($_POST['categories'] as $catId) {
			$stmtCat->bind_param('ii', $newRecordId, $catId);
			$stmtCat->execute();
		}
	}
}
?>