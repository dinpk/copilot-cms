<?php
// $key_photo_gallery fetched in renderBlocks() 
if (!$key_photo_gallery) return;

$gallery = $conn->query("SELECT * FROM photo_gallery WHERE key_photo_gallery = $key_photo_gallery AND is_active = 1")->fetch_assoc();
if (!$gallery || $gallery['available_for_blocks'] !== 1) return;
$gallery_css = $gallery['css'];
$navigation_type = $gallery['navigation_type'] ?? 'slideshow';
$valid_types = ['slideshow', 'arrows'];
if (!in_array($navigation_type, $valid_types)) {
	$navigation_type = 'slideshow';
}

// Fetch images
$images = $conn->query("
	SELECT i.*, m.file_url, m.alt_text
	FROM photo_gallery_images i
	LEFT JOIN media_library m ON i.key_media_banner = m.key_media
	WHERE i.key_photo_gallery = $key_photo_gallery AND i.is_active = 1
		AND (i.visibility_start IS NULL OR i.visibility_start <= NOW())
		AND (i.visibility_end IS NULL OR i.visibility_end >= NOW())
	ORDER BY i.sort ASC
");

// Render carousel
echo "<div class='carousel-wrapper' id='carousel-$key_photo_gallery' data-navigation-type='$navigation_type'>";
if ($navigation_type === 'arrows') {
	echo '<div class="carousel-arrow left">&#10094;</div>';
	echo '<div class="carousel-arrow right">&#10095;</div>';
}
while ($img = $images->fetch_assoc()) {
	$img_url = htmlspecialchars($img['file_url']);
	$alt_text = htmlspecialchars($img['alt_text'] ?? $img['title'] ?? '');

	echo '<div class="carousel-slide" 
				style="opacity:' . floatval($img['opacity']) . ";$gallery_css" . '"
				data-animation="' . htmlspecialchars($img['animation_type']) . '">';

	echo '<img src="' . $img_url . '" alt="' . $alt_text . '">';
	
	// Optional overlay text
	if (!empty($img['title']) || !empty($img['description'])) {
		echo '<div class="carousel-text" style="color:' . htmlspecialchars($img['text_color']) . '; text-align:' . htmlspecialchars($img['text_position']) . '">';
		echo '<h3>' . $img['title'] . '</h3>';
		echo '<p>' . htmlspecialchars($img['description']) . '</p>';
		if ($img['action_button']) {
			echo '<a href="' . htmlspecialchars($img['action_button_link_url']) . '" class="carousel-btn ' . htmlspecialchars($img['button_style']) . '">' . htmlspecialchars($img['action_button_text']) . '</a>';
		}
		echo '</div>';
	}

	echo '</div>';
}
echo '</div>';
?>
