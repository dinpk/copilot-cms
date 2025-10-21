<?php
include '../db.php';
include '../users/auth.php';

$key_image = intval($_POST['key_image'] ?? 0);
$key_media_banner = intval($_POST['key_media_banner'] ?? 0);
$key_photo_gallery = intval($_POST['key_photo_gallery'] ?? 0);
if (!$key_photo_gallery) die("Missing gallery ID");

$title = $conn->real_escape_string($_POST['title'] ?? '');
$description = $conn->real_escape_string($_POST['description'] ?? '');
$opacity = floatval($_POST['opacity'] ?? 1);
$action_button = isset($_POST['action_button']) ? 1 : 0;
$action_button_text = $conn->real_escape_string($_POST['action_button_text'] ?? '');
$action_button_link_url = $conn->real_escape_string($_POST['action_button_link_url'] ?? '');
$animation_type = $conn->real_escape_string($_POST['animation_type'] ?? 'fade');
$text_position = $conn->real_escape_string($_POST['text_position'] ?? 'center');
$text_color = $conn->real_escape_string($_POST['text_color'] ?? '#ffffff');
$image_wrapper_class = $conn->real_escape_string($_POST['image_wrapper_class'] ?? '');
$sort = intval($_POST['sort'] ?? 0);
$status = $conn->real_escape_string($_POST['status'] ?? 'on');

if ($key_image) {
	// Update existing record
	$sql = "UPDATE photo_gallery_images SET
		title = '$title',
		key_media_banner = '$key_media_banner',
		description = '$description',
		opacity = $opacity,
		action_button = $action_button,
		action_button_text = '$action_button_text',
		action_button_link_url = '$action_button_link_url',
		animation_type = '$animation_type',
		text_position = '$text_position',
		text_color = '$text_color',
		image_wrapper_class = '$image_wrapper_class',
		sort = $sort,
		status = '$status'
	WHERE key_image = $key_image";
} else {
	// Insert new record
	$sql = "INSERT INTO photo_gallery_images (
		key_photo_gallery, key_media_banner, title, description, opacity,
		action_button, action_button_text, action_button_link_url,
		animation_type, text_position, text_color, image_wrapper_class, sort, status
	) VALUES (
		$key_photo_gallery, $key_media_banner, '$title', '$description', $opacity,
		$action_button, '$action_button_text', '$action_button_link_url',
		'$animation_type', '$text_position', '$text_color', '$image_wrapper_class', $sort, '$status'
	)";
}

$conn->query($sql);

header("Location: photo_gallery_images_list.php?gallery_id=$key_photo_gallery");
?>