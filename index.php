<?php
include_once 'templates/settings.php';
include_once 'templates/template_blocks.php';


function getSetting($key, $default = null) {
	global $settings;
	return $settings[$key] ?? $default;
}


if (!isset($_COOKIE['PHPSESSID'])) {
	$cacheFolder = "cache";
	if (getSetting('cache_enabled') == 'yes') {
		$urlHash = md5($_SERVER['REQUEST_URI']);
		$cacheFile = "$cacheFolder/$urlHash";
		$cacheTime = (int)getSetting('cache_duration_days') * 24 * 60 * 60;
		if (file_exists($cacheFile) && (time() - $cacheTime < filemtime($cacheFile))) {
			$output = file_get_contents($cacheFile);
			echo replaceDynamicBlocks($output);
			echo "<!-- Cached " . date('jS F Y H:i', filemtime($cacheFile)) . " -->";
			exit;
		}
		ob_start();
	}

}

include 'router.php';

if (!isset($_COOKIE['PHPSESSID'])) {
	if (getSetting('cache_enabled') == 'yes') {
		$fp = fopen($cacheFile, "w") or die("<!-- Could not generate cache -->");
		fwrite($fp, ob_get_contents());
		fclose($fp); 
		ob_end_flush();
	}
}

?>