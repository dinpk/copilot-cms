<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

$slug = $_GET['slug'] ?? ''; // format: YYYY-MM
$page = intval($_GET['page'] ?? 1);
$limit = getSetting('snippets_per_page');
$offset = ($page - 1) * $limit;

$titlePart = date_format(date_create($slug . "-01"), "F Y");

startLayout("$titlePart");
?>

<div id="content">
  <div id="above-content">
    <?php renderBlocks("above_content"); ?>
  </div>

  <h1><?= htmlspecialchars($titlePart) ?></h1>
  <?php
  // Count total
  $countSql = "SELECT COUNT(*) AS total 
               FROM articles 
               WHERE is_active = 1 
               AND DATE_FORMAT(entry_date_time, '%Y-%m') = '$slug'";
  $total = $conn->query($countSql)->fetch_assoc()['total'];

  // Fetch records
  $sql = "SELECT a.*, m.file_url_thumbnail AS banner
          FROM articles a
          LEFT JOIN media_library m ON a.key_media_banner = m.key_media
          WHERE a.is_active = 1 
          AND DATE_FORMAT(a.entry_date_time, '%Y-%m') = '$slug'
          ORDER BY a.entry_date_time DESC
          LIMIT $limit OFFSET $offset";
  $records = $conn->query($sql);

  while ($record = $records->fetch_assoc()) {
    $banner_url = empty($record['banner_image_url']) ? $record['banner'] : $record['banner_image_url'];
    $article_snippet = (empty($record['article_snippet']) 
        ? firstWords($record['article_content'], getSetting('snippet_words')) 
        : firstWords($record['article_snippet'], getSetting('snippet_words')));
    
    echo "<div class='snippet-card'>
            <div><a href='/article/{$record['url']}'><img src='$banner_url' data-animate='fade'></a></div>
            <div class='snippet-content'>
              <h2><a href='/article/{$record['url']}'>" . htmlspecialchars($record['title']) . "</a></h2>
              <div>$article_snippet <a href='/article/{$record['url']}'>" . getSetting('readmore_label') . "</a></div>
            </div>
          </div>";
  }

	$pagination = getPagination($total, $page, $limit, "/monthly-articles/$slug?page=");
	echo $pagination['html'];
  ?>
  
  <div id="below-content">
    <?php renderBlocks("below_content"); ?>
  </div>
</div>

<div id="sidebar-right">
  <?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
