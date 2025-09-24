<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("UPDATE articles SET
    title = ?, title_sub = ?, article_snippet = ?, article_content = ?,
    url = ?, banner_image_url = ?, sort = ?, categories = ?, status = ?,
    update_date_time = CURRENT_TIMESTAMP
    WHERE key_articles = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssissi",
    $_POST['title'],
    $_POST['title_sub'],
    $_POST['article_snippet'],
    $_POST['article_content'],
    $_POST['url'],
    $_POST['banner_image_url'],
    $_POST['sort'],
    $_POST['categories'],
    $_POST['status'],
    $id
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
