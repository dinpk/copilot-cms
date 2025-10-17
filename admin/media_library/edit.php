<?php
include '../db.php';
include '../users/auth.php';
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_GET['id'])) {
	$id = intval($_GET['id']);
	$fileType = $_POST['file_type'];
	$altText = $_POST['alt_text'];
	$tags = $_POST['tags'];
	$manualUrl = trim($_POST['file_url'] ?? '');
	$finalUrl = '';
	if (isset($_FILES['media_file']) && UPLOAD_ERR_OK === $_FILES['media_file']['error']) {
		$year = date('Y');
		$targetDir = "../../media/$fileType/$year/";
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0777, true);
		}
		$filename = basename($_FILES['media_file']['name']);
		$safeName = time().'_'.preg_replace("/[^a-zA-Z0-9.\-_]/", '', $filename);
		$targetPath = $targetDir.$safeName;
		if (move_uploaded_file($_FILES['media_file']['tmp_name'], $targetPath)) {
			$finalUrl = "/media/$fileType/$year/$safeName";
		} else {
			die('⚠ Failed to move uploaded file.');
		}
		if ('image' === $fileType) {
			$maxWidth = getSetting('max_upload_image_width');
			$maxHeight = getSetting('max_upload_image_height');
			resizeImage($targetPath, $targetPath, $maxWidth, $maxHeight); // Create main image
			$thumbDir = "../../media/thumbnails/$fileType/$year/";
			if (!is_dir($thumbDir)) {
				mkdir($thumbDir, 0777, true);
			}
			$thumbPath = $thumbDir.$safeName;
			$thumbnailPath = "/media/thumbnails/$fileType/$year/$safeName";
			resizeImage($targetPath, $thumbPath, 300, 300); // Create thumbnail
		}
	} elseif ('' !== $manualUrl) {
		$finalUrl = $manualUrl;
	} else {
		$existing = $conn->query("SELECT file_url FROM media_library WHERE key_media = $id")->fetch_assoc();
		$finalUrl = $existing['file_url'];
	}
	$stmt = $conn->prepare('
	UPDATE media_library 
	SET file_url = ?, file_url_thumbnail = ?, file_type = ?, alt_text = ?, tags = ?
	WHERE key_media = ?
	');
	$stmt->bind_param('sssssi',
	$finalUrl,
	$thumbnailPath,
	$fileType,
	$altText,
	$tags,
	$id
	);
	$stmt->execute();
}
// media library form does not use submit event handler in scripts.js
header("Location: " .  $_SERVER['HTTP_REFERER']);
exit;
?>