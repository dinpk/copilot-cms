<?php 
include '../db.php';
include '../users/auth.php'; 

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $conn->query("DELETE FROM media_library WHERE key_media = $id");
}

header("Location: list.php");
exit;
?>