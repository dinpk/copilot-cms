<?php
include_once 'templates/settings.php';

function getSetting($key, $default = null) {
	global $settings;
	return $settings[$key] ?? $default;
}

$uri = str_replace("/", "", $_SERVER['REQUEST_URI']);
$ext = pathinfo(parse_url($uri, PHP_URL_PATH), PATHINFO_EXTENSION); // only html requests

if (!isset($_COOKIE['PHPSESSID']) && getSetting('cache_enabled') == 'yes') {
	$cacheFolder = "cache";
	$urlHash = md5($uri);
	$cacheFile = "$cacheFolder/$urlHash";
	$cacheTime = (int)getSetting('cache_duration_hours') * 60 * 60;
	if (file_exists($cacheFile) && (time() - $cacheTime < filemtime($cacheFile))) {
		include($cacheFile);
		echo "<!-- Cached " . date('jS F Y H:i', filemtime($cacheFile)) . " -->";
		exit;
	}
	ob_start();
}

include 'router.php';

if (!isset($_COOKIE['PHPSESSID']) && getSetting('cache_enabled') == 'yes' && $ext == '') {
	$fp = fopen($cacheFile, "w") or die("<!-- Could not generate cache -->");
	fwrite($fp, ob_get_contents());
	fclose($fp); 
	ob_end_flush();
}

?>