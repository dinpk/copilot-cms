<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get page info
$page = $conn->query("SELECT p.*, m.file_url AS banner_url  
                      FROM pages p 
                      LEFT JOIN media_library m ON p.key_media_banner = m.key_media 
                      WHERE p.url = '$slug' AND p.status = 'on'")->fetch_assoc();

if (!$page) {
  echo "⚠ Page not found.";
  exit;
}

startLayout(htmlspecialchars($page['title']));

?>


<div id="content">


	<h1><?= htmlspecialchars($page['title']) ?></h1>

	<?php if (!empty($page['title_sub'])): ?>
	  <h3><?= htmlspecialchars($page['title_sub']) ?></h3>
	<?php endif; ?>

	<?php
		if ($page['banner_image_url']) { // pasted link url from articles table
			echo "<div id='main-banner' style='background-image:url(" . $page['banner_image_url'] . ")'></div>";
		} else if ($page['banner_url']) { // uploaded file url from media_library table
			echo "<div id='main-banner' style='background-image:url(" . $page['banner_url'] . ")'></div>";
		}
	?>

	<div><?= $page['page_content'] ?></div>

</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>


<?php endLayout(); ?>
