<?php include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $book_id = intval($_POST['key_books']);
  $conn->query("DELETE FROM book_articles WHERE key_books = $book_id");

  if (!empty($_POST['key_articles'])) {
    foreach ($_POST['key_articles'] as $article_id) {
      $stmt = $conn->prepare("INSERT INTO book_articles (key_books, key_articles) VALUES (?, ?)");
      $stmt->bind_param("ii", $book_id, $article_id);
      $stmt->execute();
    }
  }
}
