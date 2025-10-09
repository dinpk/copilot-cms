<?php

function startLayout($title = "CopilotCMS") {

	echo "<!DOCTYPE html><html><head><title>$title</title>
        <link rel='stylesheet' href='style.css'>
        </head><body>
		<nav>";
	renderMainMenu();
	echo "</nav><div class='container'>";
}

function endLayout() {
  echo "</div></body></html>";
}


// Main Menu
function renderMainMenu() {
	global $conn;
  $res = $conn->query("SELECT title, url_link FROM main_menu WHERE status = 'on' ORDER BY sort");
  echo "<nav class='main-menu'>";
  while ($row = $res->fetch_assoc()) {
    echo "<a href='" . htmlspecialchars($row['url_link']) . "'>" . htmlspecialchars($row['title']) . "</a> ";
  }
  echo "</nav>";
}


// Blocks
function renderBlocks($conn, $region, $currentPage) {
  $res = $conn->query("SELECT block_content FROM blocks 
                       WHERE status = 'on' 
                       AND show_in_region = '$region' 
                       AND (show_on_pages = '' OR FIND_IN_SET('$currentPage', show_on_pages)) 
                       ORDER BY sort");
  while ($row = $res->fetch_assoc()) {
    echo "<div class='block'>" . $row['block_content'] . "</div>";
  }
}


?>