<?php

Locale::setDefault('ur_PK');

$page_slug = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

function startLayout($title = "CopilotCMS") {
	echo "
	<!DOCTYPE html>
	<html>
		<head>
			<title>$title</title>
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
			<link rel='stylesheet' href='/templates/settings.css'>
			<link rel='stylesheet' href='/templates/default/style.css?version=" . getSetting("css_version") . "'>
			<link rel='stylesheet' href='/templates/carousel.css'>
        </head>
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



	echo "<div id='breadcrumb' data-animate='fade'>";
	global $segments;
	$breadcrumbs = generateBreadcrumb($segments);
	for ($i = 0; $i < sizeof($breadcrumbs); $i++) {
		$crumb = $breadcrumbs[$i];
		if ($i < 2) {
			echo '<a href="' . htmlspecialchars($crumb['url']) . '">' . htmlspecialchars($crumb['label']) . '</a>';
		} else {
			echo htmlspecialchars($crumb['label']);
		}
		if ($i < sizeof($breadcrumbs)-1) echo ' &raquo; ';
	}
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
	<script src='/templates/carousel.js'></script>
	";
}

?>