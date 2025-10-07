<?php include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM main_menu WHERE key_main_menu = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
