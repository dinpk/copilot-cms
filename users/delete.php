<?php include '../db.php';

if (!isset($_GET['id'])) {
  die("Missing user ID.");
}

$id = intval($_GET['id']);
$conn->query("UPDATE users SET status = 'off' WHERE key_user = $id");

header("Location: list.php");
exit;
?>