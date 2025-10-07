<?php
session_start();
if (!isset($_SESSION['key_user'])) {
  header("Location: ../users/login.php");
  exit;
}
?>