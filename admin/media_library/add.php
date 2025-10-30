<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('admin' != $_SESSION['role'] && 'creaditor' != $_SESSION['role']) {
	echo "'⚠ You do not have access to add a record';";
	exit;
}
if ('POST' === $_SERVER['REQUEST_METHOD']) {
	$uploadedBy = $_SESSION['key_user'];
	$fileType = $_POST['file_type'];
	$altText = $_POST['alt_text'];
	$tags = $_POST['tags'];
	$manualUrl = trim($_POST['file_url'] ?? '');
	$finalUrl = '';
	if (isset($_FILES['media_file']) && UPLOAD_ERR_OK === $_FILES['media_file']['error']) {
		// path
		$year = date('Y');
		$targetDir = "../../media/$fileType/$year/";
		if (!is_dir($targetDir)) {
			mkdir($targetDir, 0777, true);
		}
		// image
		$filename = basename($_FILES['media_file']['name']);
		$safeName = time().'_'.preg_replace("/[^a-zA-Z0-9.\-_]/", '', $filename);
		$targetPath = $targetDir.$safeName;

		if (move_uploaded_file($_FILES['media_file']['tmp_name'], $targetPath)) {
			$finalUrl = "/media/$fileType/$year/$safeName";
		} else {
			die('⚠ Failed to move uploaded file.');
		}
		// thumbnail
		if ('images' === $fileType) {
			$maxWidth = getSetting('max_upload_image_width');
			$maxHeight = getSetting('max_upload_image_height');
			resizeImage($targetPath, $targetPath, $maxWidth, $maxHeight); // Resize original
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
		die('⚠ No file uploaded and no URL provided.');
	}
	$stmt = $conn->prepare('
	INSERT INTO 
	media_library (file_url, file_url_thumbnail, file_type, alt_text, tags, uploaded_by ) 
	VALUES (?, ?, ?, ?, ?, ?)
	');
	$stmt->bind_param('sssssi',
	$finalUrl,
	$thumbnailPath,
	$fileType,
	$altText,
	$tags,
	$uploadedBy
  );
	$stmt->execute();
}
// media library form does not use submit event handler in scripts.js
header('Location: list.php'); 
exit;
?>