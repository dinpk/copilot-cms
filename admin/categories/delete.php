<?php include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM categories WHERE key_categories = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
