<?php
include_once 'templates/settings.php';
include_once 'templates/template_blocks.php';

function getSetting($key, $default = null) {
	global $settings;
	return $settings[$key] ?? $default;
}

$uri = $_SERVER['REQUEST_URI'];
$ext = pathinfo(parse_url($uri, PHP_URL_PATH), PATHINFO_EXTENSION);

if (!isset($_COOKIE['PHPSESSID'])) {
	$cacheFolder = "cache";
	if (getSetting('cache_enabled') == 'yes') {
		
		$urlHash = md5($uri);
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

if (!isset($_COOKIE['PHPSESSID']) && getSetting('cache_enabled') == 'yes' && $ext == '') {
    $buffer = ob_get_contents();
    ob_end_clean(); // stop buffering, don’t flush twice

    // Write raw buffer (with placeholders) to cache
    $fp = fopen($cacheFile, "w") or die("<!-- Could not generate cache -->");
    fwrite($fp, $buffer);
    fclose($fp);

    // Output processed buffer (replace placeholders for this request)
    echo replaceDynamicBlocks($buffer);
} else {
    ob_end_flush(); // normal path if caching not enabled
}

?>