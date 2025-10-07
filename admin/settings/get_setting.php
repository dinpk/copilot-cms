<?php 
include '../db.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $result = $conn->query("SELECT * FROM settings WHERE key_settings = $id");
  echo json_encode($result->fetch_assoc());
}
?>