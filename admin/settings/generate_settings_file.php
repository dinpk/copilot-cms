<?php
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
if ('viewer' == $_SESSION['role']) {
	echo "'⚠ You do not have access to edit a record';";
	exit;
}

$settingsArray = [];
$generatedCSS = "";
$googleFontsArray = [];

$sql = "SELECT setting_key, setting_value, setting_group FROM settings WHERE is_active = 1";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	if (strpos($row['setting_group'], 'css_') > -1) {
		$generatedCSS .= "--" . str_replace("_", "-", $row['setting_key']) . ":" . $row['setting_value'] . ";\n	";
	}
	if ($row['setting_key'] == 'google_fonts') {
		$googleFontsArray = explode(",", $row['setting_value']);
	}
	$settingsArray[$row['setting_key']] = $row['setting_value'];
}


// settings.css
$generatedCSS = ":root {
	$generatedCSS
}
";
$googleFonts = "";
foreach ($googleFontsArray as $font) {
	$googleFonts .= "@import url('https://fonts.googleapis.com/css2?family=" . $font . ":wght@400&display=swap');\n";
}
file_put_contents('../../templates/settings.css', $googleFonts . "\n" . $generatedCSS);


// settings.php
foreach ($settingsArray as $key => $value) {
	$escapedValue = var_export($value, true);
	$lines[] = "\$settings['{$key}'] = {$escapedValue};";
}
$lines_text = implode("\n", $lines);
file_put_contents('../../templates/settings.php', "<?php\n\$settings = [];\n$lines_text");


?>