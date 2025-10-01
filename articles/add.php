<?php 
include '../db.php';
include '../users/auth.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
  $status = isset($_POST['status']) ? 'on' : 'off';	
  $createdBy = $_SESSION['key_user'];
  
  $stmt = $conn->prepare("INSERT INTO articles (
    title, title_sub, article_snippet, article_content,
    content_type, url, banner_image_url, sort, status, created_by
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssssssisi",
    $_POST['title'],
    $_POST['title_sub'],
    $_POST['article_snippet'],
    $_POST['article_content'],
    $_POST['content_type'],
	$_POST['url'],
    $_POST['banner_image_url'],
    $_POST['sort'],
    $status,
	$createdBy
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

header("Location: list.php");
exit;
