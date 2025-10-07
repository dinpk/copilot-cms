<?php include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM articles WHERE key_articles = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
