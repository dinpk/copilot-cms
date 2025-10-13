<?php 
include __DIR__ . '/../../admin/db.php';
include __DIR__ . '/layout.php';

$slug = $_GET['slug'] ?? '';
$slug = $conn->real_escape_string($slug);

// Get page info
$page = $conn->query("SELECT p.*, m.file_url AS banner 
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
	if ($page['banner']) {
		echo "<div><img src='" . htmlspecialchars($page['banner']) . "' width='600'></div>";
	}
	?>

	<div><?= $page['page_content'] ?></div>

</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>


<?php endLayout(); ?>
