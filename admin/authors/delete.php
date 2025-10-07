<?php include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM authors WHERE key_authors = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
