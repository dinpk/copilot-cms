<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $conn->prepare("INSERT INTO articles (
    title, title_sub, article_snippet, article_content,
    content_type, url, banner_image_url, sort, categories, status
  ) VALUES (?, ?, ?, ?, 'article', ?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssisss",
    $_POST['title'],
    $_POST['title_sub'],
    $_POST['article_snippet'],
    $_POST['article_content'],
    $_POST['url'],
    $_POST['banner_image_url'],
    $_POST['sort'],
    $_POST['categories'],
    $_POST['status']
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
