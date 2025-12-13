<?php 
include(__DIR__ . '/../../dbconnection.php');
include(__DIR__ . '/../template_content.php');
include(__DIR__ . '/layout.php');

startLayout("Articles by Month");
?>

<div id="content">
  <div id="above-content">
    <?php renderBlocks("above_content"); ?>
  </div>

  <h1>Articles by Month</h1>
  <?php
  // Fetch distinct year-months
  $sql = "SELECT DISTINCT DATE_FORMAT(entry_date_time, '%Y') AS year,
                          DATE_FORMAT(entry_date_time, '%M') AS month,
                          DATE_FORMAT(entry_date_time, '%Y-%m') AS ym
          FROM articles
          WHERE is_active = 1
          ORDER BY year DESC, ym DESC";
  $result = $conn->query($sql);

  $monthsByYear = [];
  while ($row = $result->fetch_assoc()) {
    $monthsByYear[$row['year']][] = $row;
  }

  foreach ($monthsByYear as $year => $months) {
    echo "<details>";
    echo "<summary><strong>$year</strong></summary>";
    echo "<ul>";
    foreach ($months as $m) {
      echo "<li><a href='/monthly-articles/{$m['ym']}'>" . htmlspecialchars($m['month']) . "</a></li>";
    }
    echo "</ul>";
    echo "</details>";
  }
  ?>
  
  <div id="below-content">
    <?php renderBlocks("below_content"); ?>
  </div>
</div>

<div id="sidebar-left">
  <?php renderBlocks("sidebar_left"); ?>
</div>
<div id="sidebar-right">
  <?php renderBlocks("sidebar_right"); ?>
</div>

<?php endLayout(); ?>
