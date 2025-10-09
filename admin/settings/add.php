<?php 
include '../db.php';
include '../users/auth.php';

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $is_active = isset($_POST['is_active']) ? 1 : 0;

  $stmt = $conn->prepare("INSERT INTO settings (
    setting_key, setting_value, setting_group, setting_type, is_active
  ) VALUES (?, ?, ?, ?, ?)");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssi",
    $_POST['setting_key'],
    $_POST['setting_value'],
    $_POST['setting_group'],
    $_POST['setting_type'],
    $is_active
  );

  $stmt->execute();
}
?>