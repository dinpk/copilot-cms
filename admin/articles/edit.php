<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] == "viewer") {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

	  if (isUrlTaken($_POST["url"], "articles", $id)) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

  $status = isset($_POST['status']) ? 'on' : 'off';	
  $updatedBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("UPDATE articles SET
    title = ?, title_sub = ?, article_snippet = ?, article_content = ?,
    url = ?, content_type = ?, book_indent_level = ?, banner_image_url = ?, sort = ?, status = ?,
    updated_by = ?, key_media_banner = ?
    WHERE key_articles = ?");

print_r($id);

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssisisiii",
    $_POST['title'],
    $_POST['title_sub'],
    $_POST['article_snippet'],
    $_POST['article_content'],
    $_POST['url'],
    $_POST['content_type'],
    $_POST['book_indent_level'],
    $_POST['banner_image_url'],
    $_POST['sort'],
    $status,
	$updatedBy,
	$_POST['key_media_banner'],
    $id
  );

  $stmt->execute();


	/*
	if (!$stmt->execute()) {
	  die("Execute failed: " . $stmt->error);
	}
	*/
  
  
	$conn->query("DELETE FROM article_categories WHERE key_articles = $id");

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO article_categories (key_articles, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $id, $catId);
		$stmtCat->execute();
	  }
	}
   
  
  
}
?>