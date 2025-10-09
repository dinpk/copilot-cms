<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] == "viewer") {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("UPDATE media_library SET
    file_url = ?, file_type = ?, alt_text = ?, tags = ?
    WHERE key_media = ?");

  $stmt->bind_param("ssssi",
    $_POST['file_url'],
    $_POST['file_type'],
    $_POST['alt_text'],
    $_POST['tags'],
    $id
  );

  $stmt->execute();
}
?>