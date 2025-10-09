<?php 
include '../db.php';
include '../users/auth.php'; 

if ($_SESSION["role"] == "viewer") {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
  $id = intval($_GET['id']);

	  if (isUrlTaken($_POST["url"], "authors", $id)) {
		  echo "❌ This URL is already used in another module. Please choose a unique one.";
		  exit;
	  }

	$status = isset($_POST['status']) ? 'on' : 'off';

	$updatedBy = $_SESSION['key_user'];

  $stmt = $conn->prepare("UPDATE authors SET
    name = ?, email = ?, phone = ?, website = ?, url = ?,
    social_url_media1 = ?, social_url_media2 = ?, social_url_media3 = ?,
    city = ?, state = ?, country = ?, image_url = ?, description = ?, status = ?,
    updated_by = ?, key_media_banner = ? 
    WHERE key_authors = ?");

  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("ssssssssssssssiii",
    $_POST['name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['website'],
    $_POST['url'],
    $_POST['social_url_media1'],
    $_POST['social_url_media2'],
    $_POST['social_url_media3'],
    $_POST['city'],
    $_POST['state'],
    $_POST['country'],
    $_POST['image_url'],
    $_POST['description'],
    $status,
	$updatedBy,
	$_POST['key_media_banner'],
    $id
  );

  $stmt->execute();
}
?>