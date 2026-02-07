<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ($_SESSION["role"] != "admin" && $_SESSION["role"] != "creaditor") {
	die("⚠ Access denied.");
}

$uploadedBy = $_SESSION['key_user'];
$tags = $_POST['tags'] ?? '';
$year = date('Y');
$fileType = 'images';

$maxWidth = getSetting('max_upload_image_width');
$maxHeight = getSetting('max_upload_image_height');


foreach ($_FILES['bulk_files']['tmp_name'] as $i => $tmpPath) {

	if ($_FILES['bulk_files']['error'][$i] !== UPLOAD_ERR_OK) continue;

	$filename = basename($_FILES['bulk_files']['name'][$i]);
	$safeName = time() . "_" . $i . "_" . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $filename);

	$targetDir = "../../media/$fileType/$year/";
	$thumbDir = "../../media/thumbnails/$fileType/$year/";
	if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
	if (!is_dir($thumbDir)) mkdir($thumbDir, 0777, true);

	$targetPath = $targetDir . $safeName;
	$thumbPath = $thumbDir . $safeName;

	move_uploaded_file($tmpPath, $targetPath);
	resizeImage($targetPath, $targetPath, $maxWidth, $maxHeight);
	resizeImage($targetPath, $thumbPath, 300, 300);

	$relativeUrl = "/media/$fileType/$year/$safeName";
	$thumbRelUrl = "/media/thumbnails/$fileType/$year/$safeName";

	$stmt = $conn->prepare("INSERT INTO media_library (
		file_url, file_url_thumbnail, file_type, tags, uploaded_by
	) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssi", $relativeUrl, $thumbRelUrl, $fileType, $tags, $uploadedBy);
	$stmt->execute();
	


	
}

header("Location: " .  $_SERVER['HTTP_REFERER']);
exit;
?>