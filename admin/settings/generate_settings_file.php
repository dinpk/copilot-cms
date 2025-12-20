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


$result = $conn->query("SELECT setting_key, setting_value, setting_group FROM settings");
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

$uploadedFonts = "";
$result = $conn->query("SELECT * FROM fonts");
while ($row = $result->fetch_assoc()) {
	$uploadedFonts .= "@font-face {font-family:'" . $row['font_label'] . "';font-style:normal;font-weight:400;src:url(/fonts/" . $row['file_name'] . ") format('truetype');}\n";
}

file_put_contents('../../templates/settings.css', $googleFonts . $uploadedFonts . "\n" . $generatedCSS);


// settings.php
foreach ($settingsArray as $key => $value) {
	$escapedValue = var_export($value, true);
	$lines[] = "\$settings['{$key}'] = {$escapedValue};";
}
$lines_text = implode("\n", $lines);
file_put_contents('../../templates/settings.php', "<?php\n\$settings = [];\n$lines_text");


?>