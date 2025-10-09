<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	  if (isUrlTaken($_POST["url"], "articles")) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

	
  $status = isset($_POST['status']) ? 'on' : 'off';	
  $createdBy = $_SESSION['key_user'];
  
  $stmt = $conn->prepare("INSERT INTO articles (
    title, title_sub, article_snippet, article_content,
    content_type, url, banner_image_url, sort, status, created_by, key_media_banner
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssssisii",
    $_POST['title'],
    $_POST['title_sub'],
    $_POST['article_snippet'],
    $_POST['article_content'],
    $_POST['content_type'],
	$_POST['url'],
    $_POST['banner_image_url'],
    $_POST['sort'],
    $status,
	$createdBy,
	$_POST['key_media_banner']
  );

  $stmt->execute();


  
	$newRecordId = $conn->insert_id;

	if (!empty($_POST['categories'])) {
	  $stmtCat = $conn->prepare("INSERT IGNORE INTO article_categories (key_articles, key_categories) VALUES (?, ?)");
	  foreach ($_POST['categories'] as $catId) {
		$stmtCat->bind_param("ii", $newRecordId, $catId);
		$stmtCat->execute();
	  }
	}
    
	

	
  
}
