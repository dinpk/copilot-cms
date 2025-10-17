<?php 
include '../db.php';
include '../users/auth.php'; 

if (isset($_GET['id'])) {
	$id = intval($_GET['id']);

	$stmt = $conn->prepare("SELECT file_url, file_url_thumbnail FROM media_library WHERE key_media = ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result()->fetch_assoc();

	if ($result) {
		$mainPath = "../.." . $result['file_url'];
		$thumbPath = "../.." . $result['file_url_thumbnail'];

		if (file_exists($mainPath)) {
			unlink($mainPath);
		}
		if (file_exists($thumbPath)) {
			unlink($thumbPath);
		}
	}

	// Delete DB record
	$conn->query("DELETE FROM media_library WHERE key_media = $id");
}

header("Location: list.php");
exit;
?>
