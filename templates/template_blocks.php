<?php

include_once(__DIR__ . '/../dbconnection.php');

function renderBlocks($region = null, $currentPage = '', $forceDynamic = false, $blockId = null) {
    global $conn;

    // Build query: either all blocks in region OR a single block by ID
    if ($blockId !== null) {
        $sql = "SELECT * FROM blocks WHERE key_blocks = " . (int)$blockId . " AND is_active = 1";
    } else {
        $sql = "SELECT * FROM blocks 
                   WHERE is_active = 1  
                   AND show_in_region = '" . $conn->real_escape_string($region) . "' 
                   AND (show_on_pages = '' OR FIND_IN_SET('" . $conn->real_escape_string($currentPage) . "', show_on_pages)) 
                   ORDER BY sort";
    }

    $res = $conn->query($sql);

    while ($row = $res->fetch_assoc()) {
        $devices_array = explode(',', $row['visible_on']);
        $visibilityClasses = '';
        foreach ($devices_array as $device) $visibilityClasses .= ' visible-on-' . $device;

        $blockId = $row['key_blocks'];

        // If block is dynamic and we’re writing cache (not forced dynamic), output placeholder
        if ($row['is_dynamic'] && !$forceDynamic && getSetting('cache_enabled') == 'yes' && !isset($_COOKIE['PHPSESSID'])) {
            echo "<!--DYNAMIC:$blockId-->";
            continue;
        }

        // Otherwise render normally
        echo "<div class='block $visibilityClasses'>";
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
        echo "<div class='block-content'>" . $row['block_content'] . "</div>";
		
		// variables used by included modules
		$key_photo_gallery = $row['key_photo_gallery'];
		$key_content_types = $row['key_content_types'];
		$key_categories = $row['key_categories'];
		$key_tags = $row['key_tags'];
		$css = $row['css'];
		$number_of_records = $row['number_of_records'];
		
        if ($row['module_file'] != '') {
            include("modules/" . $row['module_file'] . ".php");
        }
        echo "</div>";
    }
}

function replaceDynamicBlocks($output) {
    return preg_replace_callback(
        '/<!--DYNAMIC:(\d+)-->/',
        function($matches) {
            ob_start();
            renderBlocks(null, '', true, (int)$matches[1]);
            return ob_get_clean();
        },
        $output
    );
}

 
/*
function renderBlocks($region, $currentPage = '') {
	global $conn;
	$sql = "SELECT * FROM blocks 
					   WHERE is_active = 1  
					   AND show_in_region = '$region' 
					   AND (show_on_pages = '' OR FIND_IN_SET('$currentPage', show_on_pages)) 
					   ORDER BY sort";
	$res = $conn->query($sql);
	// echo __FILE__;
	while ($row = $res->fetch_assoc()) {
		$devices_array = explode(',', $row['visible_on']);
		$visibilityClasses = '';
		foreach ($devices_array as $device) $visibilityClasses .= ' visible-on-' . $device;
		
		echo "<div class='block $visibilityClasses'>";
		echo "<h2>" . $row['title'] . "</h2>";
		echo "<div class='block-content'>" .  $row['block_content'] . "</div>";

		// variables used by included modules
		$key_photo_gallery = $row['key_photo_gallery'];
		$key_content_types = $row['key_content_types'];
		$key_categories = $row['key_categories'];
		$key_tags = $row['key_tags'];
		$css = $row['css'];
		$number_of_records = $row['number_of_records'];

		if ($row['module_file'] != '') {
			include("modules/" . $row['module_file'] . ".php");
		}
		echo "</div>";
	}
}
*/

?>