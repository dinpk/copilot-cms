<?php

$page_slug = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

function startLayout($title = "CopilotCMS") {
	echo "
	<!DOCTYPE html>
	<html>
		<head>
			<title>$title</title>
			<meta charset='utf-8'>
			<link rel='stylesheet' href='/templates/default/style.css'>
        </head>
		<style>
			:root {
				--template-text-color:  " . getSetting('template_text_color') . ";
				--template-background-color:  " . getSetting('template_background_color') . ";
				--template-font-family: " . getSetting('template_font_family') . ";
				--sidebar-background-color:  " . getSetting('sidebar_background_color') . ";
				--content-background-color:  " . getSetting('content_background_color') . ";
				--items-background-color:  " . getSetting('items_background_color') . ";
			}
		</style>
	<body>";

	echo "<div id='above-header'>";
		renderBlocks("above_header");
	echo "</div>";

	echo "<header data-animate='fade'>";
		echo "<div id='site-logo'><a href='/home'><img src='" . getSetting("template_default_logo") . "'></a></div>";
		renderMainMenu();
	echo "</header>";

	global $page_slug;
	echo "<div id='below_header'>";
	renderBlocks("below_header", $page_slug);
	echo "</div>";
	
	echo "<main>";
}


function endLayout() {
	echo "</main>";
	global $page_slug;

	echo "<div id='above-footer'>";
		renderBlocks("above_footer", $page_slug);
	echo "</div>";

	echo "<div id='footer'>";
		renderBlocks("footer", $page_slug);
	echo "</div>";
	echo "<div id='below-footer'>";
		renderBlocks("below_footer", $page_slug);
	echo "</div>";
	echo "</body></html>
	<script src='/templates/default/script.js'></script>
	";
}


// Main Menu
function getMenuItems() {
    global $conn;
    $items = [];
    $res = $conn->query("SELECT key_main_menu, parent_id, title, url_link FROM main_menu WHERE status = 'on' ORDER BY sort");
    while ($row = $res->fetch_assoc()) {
        $items[$row['parent_id']][] = $row;
    }
    return $items;
}
function renderMenuTree($items, $parent_id = 0) {
    if (!isset($items[$parent_id])) return;

    echo "<ul>";
    foreach ($items[$parent_id] as $item) {
        echo "<li><a href='" . htmlspecialchars($item['url_link']) . "'>" . htmlspecialchars($item['title']) . "</a>";
        renderMenuTree($items, $item['key_main_menu']); // Recursion for children
        echo "</li>";
    }
    echo "</ul>";
}
function renderMainMenu() {
    $items = getMenuItems();
	
	echo "<button class='menu-toggle' onclick=\"document.querySelector('.main-menu').classList.toggle('open')\">☰ Menu</button>";
	
    echo "<nav class='main-menu'>";
    renderMenuTree($items);
    echo "</nav>";
}


// Blocks
function renderBlocks($region, $currentPage = '') {
	global $conn;
	$sql = "SELECT key_blocks, key_photo_gallery, title, block_content, module_file, visible_on FROM blocks 
					   WHERE status = 'on' 
					   AND show_in_region = '$region' 
					   AND (show_on_pages = '' OR FIND_IN_SET('$currentPage', show_on_pages)) 
					   ORDER BY sort";
	$res = $conn->query($sql);
	// echo __FILE__;
	while ($row = $res->fetch_assoc()) {
		$devices_array = explode(',', $row['visible_on']);
		$visibilityClasses = '';
		foreach ($devices_array as $device) $visibilityClasses .= ' visible-on-' . $device;
		$key_photo_gallery = $row['key_photo_gallery'];
		echo "<div class='block $visibilityClasses'>";
		echo "<h2>" . $row['title'] . "</h2>";
		echo "<div class='block-content'>" .  $row['block_content'] . "</div>";
		if ($row['module_file'] != '') {
			include("modules/" . $row['module_file'] . ".php");
		}
		echo "</div>";
	}
}



/**
 * Clean HTML by removing specific tags and wrapping text nodes in <p>.
 *
 * @param string $html The raw HTML input.
 * @param array $tagsToRemove Tags to remove completely (e.g., ['script', 'h1']).
 * @return string Sanitized HTML with <p>-wrapped text.
 */
function unwantedTagsToParagraphs(string $html, array $tagsToRemove = []): string {
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    // Remove unwanted tags and their content
    foreach ($tagsToRemove as $tag) {
        while (true) {
            $elements = $doc->getElementsByTagName($tag);
            if ($elements->length === 0) break;
            $elements->item(0)->parentNode->removeChild($elements->item(0));
        }
    }

    // Wrap orphaned text nodes in <p>
    $body = $doc->getElementsByTagName('body')->item(0);
    $cleanHtml = '';
    foreach ($body->childNodes as $node) {
        if ($node->nodeType === XML_TEXT_NODE) {
            $text = trim($node->textContent);
            if ($text !== '') {
                $cleanHtml .= '<p>' . htmlspecialchars($text) . '</p>';
            }
        } else {
            $cleanHtml .= $doc->saveHTML($node);
        }
    }

    return $cleanHtml;
}


?>