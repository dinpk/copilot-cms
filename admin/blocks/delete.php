<?php include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "DELETE FROM blocks WHERE key_blocks = $id";
  $conn->query($sql);
}

header("Location: list.php");
exit;
