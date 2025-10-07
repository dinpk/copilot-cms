<?php include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM pages WHERE key_pages = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
