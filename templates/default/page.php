<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? '';
$page = $author = getPageBySlug($conn, $slug);

if (!$page) {
  echo "⚠ Page not found.";
  exit;
}
startLayout(htmlspecialchars($page['title']));
?>
<div id="content">
	<?php
	echo "<h1>" . htmlspecialchars($page['title']) . "</h1>";
	if (!empty($page['title_sub'])) echo "<h3>" . htmlspecialchars($page['title_sub']) . "</h3>";
	if ($page['banner_image_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $page['banner_image_url'] . ")'></div>";
	} else if ($page['banner_url']) {
		echo "<div id='content-banner' style='background-image:url(" . $page['banner_url'] . ")'></div>";
	}
	echo "<div>" . $page['page_content'] . "</div>";
	?>
</div>

<div id="sidebar">
	<?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>