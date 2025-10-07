<?php 
include '../db.php';
include '../users/auth.php'; 

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $conn->query("UPDATE settings SET is_active = 0 WHERE key_settings = $id");
}
?>