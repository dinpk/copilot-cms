<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor" ) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uploadedBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("INSERT INTO media_library (
    file_url, file_type, alt_text, tags, uploaded_by
  ) VALUES (?, ?, ?, ?, ?)");

  $stmt->bind_param("ssssi",
    $_POST['file_url'],
    $_POST['file_type'],
    $_POST['alt_text'],
    $_POST['tags'],
    $uploadedBy
  );

  $stmt->execute();
}

header("Location: list.php");
exit;
?>