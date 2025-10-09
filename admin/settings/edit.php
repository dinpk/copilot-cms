<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] == "viewer") {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $is_active = isset($_POST['is_active']) ? 1 : 0;

  $stmt = $conn->prepare("UPDATE settings SET
    setting_key = ?, setting_value = ?, setting_group = ?, setting_type = ?, is_active = ?,
    entry_date_time = CURRENT_TIMESTAMP
    WHERE key_settings = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssii",
    $_POST['setting_key'],
    $_POST['setting_value'],
    $_POST['setting_group'],
    $_POST['setting_type'],
    $is_active,
    $id
  );

  $stmt->execute();
}
?>