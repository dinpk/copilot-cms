<?php include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM books WHERE key_books = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
