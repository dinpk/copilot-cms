<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? '';
$sql = "SELECT a.*, m.file_url AS banner_url FROM photo_gallery a
			LEFT JOIN media_library m ON a.key_media_banner = m.key_media
				WHERE a.url = '$slug' AND a.is_active = 1";
$gallery = $conn->query($sql)->fetch_assoc();

if (!$gallery) {
  echo "⚠ Article not found or not published.";
  exit;
}
startLayout(htmlspecialchars($gallery['title']));
?>
<div id="content">

	<div id="above-content">
		<?php renderBlocks("above_content"); ?>
	</div>

	<article>
	<h1>
		<?= htmlspecialchars($gallery['title']) ?>
	</h1>
	

	<?php

	echo "<div>" . $gallery['description'] . "</div>";

	if ($gallery['image_url']) { // full link url
		echo "<div id='content-banner'><img src='" . $gallery['image_url'] . "'></div>";
	} else if ($gallery['banner_url']) { // media library file
		echo "<div id='content-banner'><img src='" . $gallery['banner_url'] . "'></div>";
	}
	
	$galley_id = $gallery['key_photo_gallery'];
	
	$result = $conn->query("SELECT a.*, m.file_url AS banner_url FROM photo_gallery_images a
							LEFT JOIN media_library m ON a.key_media_banner = m.key_media
								WHERE a.key_photo_gallery = $galley_id AND a.is_active = 1");
	echo "<div>";
	while ($row = $result->fetch_assoc()) {
		$title = htmlspecialchars($row['title']);
		$description = htmlspecialchars($row['description']);
		echo "<h3>$title</h3>";
		echo "<p>$description</p>";
		echo "<div id='content-banner'><img src='" . $row['banner_url'] . "'></div>";
	}
	echo "</div>";	
	
	?>
	</article>


	
	<div id="below-content">
		<?php renderBlocks("below_content"); ?>
	</div>
	
</div>
<div id="sidebar-right">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>