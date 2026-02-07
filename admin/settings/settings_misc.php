<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 

startLayout("Settings Misc");

$message = '';


?>
	

	<br>
	
	
	<!-- ------------------------- CLEAR CACHE -->

	<?php
	if (isset($_POST['clear_cache'])) {

		$cacheFolder = "../../cache";

		if (isset($_POST["home"])) {
			$fileHash = md5("home");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)){
				unlink($cacheFile);
				$message = "<div class='success-message'>Cache cleared successfully.</div>";
			}
			$cacheFile = "$cacheFolder/home";
			if (file_exists($cacheFile)){
				unlink($cacheFile);
				$message = "<div class='success-message'>Cache cleared successfully.</div>";
			}
		}

		if (isset($_POST["articles"])) {
			$fileHash = md5("articles");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["content_types"])) {
			$fileHash = md5("content-types");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["categories"])) {
			$fileHash = md5("categories");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["tags"])) {
			$fileHash = md5("tags");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["pages"])) {
			$fileHash = md5("pages");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["authors"])) {
			$fileHash = md5("authors");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["books"])) {
			$fileHash = md5("books");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["photo_gallery"])) {
			$fileHash = md5("photo-gallery");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["youtube_gallery"])) {
			$fileHash = md5("youtube-gallery");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["users"])) {
			$fileHash = md5("users");
			$cacheFile = "$cacheFolder/$fileHash";
			if (file_exists($cacheFile)) unlink($cacheFile);
			$message = "<div class='success-message'>Cache cleared successfully.</div>";
		}

		if (isset($_POST["all"])) {
			$files = glob($cacheFolder . '/*');
			if (array_walk($files, function ($file) {unlink($file);})) {
				$message = "<div class='success-message'>Cache cleared successfully.</div>";
			} else {
				$message = "<div class='failure-result'>Some error occured, could not clear cache</div>";
			}
		}
		
		echo $message;
			
	} // clear cache
	?>
	<fieldset>
		<legend>Clear Cache</legend>
		<form method="post">
		<div style='columns:5;column-gap:40px;padding:20px;'>
			<input type="checkbox" name="home"> Home<br>
			<input type="checkbox" name="articles"> Articles<br>
			<input type="checkbox" name="content_types"> Content Types<br>
			<input type="checkbox" name="categories"> Categories<br>
			<input type="checkbox" name="tags"> Tags<br>
			<input type="checkbox" name="pages"> Pages<br>
			<input type="checkbox" name="authors"> Authors<br>
			<input type="checkbox" name="books"> Books<br>
			<input type="checkbox" name="photo_gallery"> Photo Gallery<br>
			<input type="checkbox" name="youtube_gallery"> Youtube Gallery<br>
			<input type="checkbox" name="users"> Users<br>
			<input type="checkbox" name="all"> All cache<br>
		</div>
		<input name="clear_cache" type="submit" value="Clear Cache">
		</form>	
	</fieldset>
		
	<br>
		
		
		
		
		
	<!-- ------------------------- TEMPLATE FOLDER -->
		
	<?php
		if (isset($_POST['set_template_folder'])) {
			$template_folder = $_POST['template_folder'];
			$sql = "UPDATE settings SET template_folder = '$template_folder' WHERE key_settings = 1";
			$conn->query($sql);
			
			echo "<div class='success-message'>Template '$template_folder' is set as a default template.</div>";
		}
		
	?>
		
	<fieldset>
		<legend>Template Folder</legend>
		<form method="post">
		<?php
			$settings_row = $conn->query("SELECT template_folder FROM settings WHERE key_settings = 1")->fetch_assoc();
			$template_folder = $settings_row["template_folder"];
			$folders = array_filter(glob('../../templates/*'), 'is_dir');
			$templateOptions = array_map('basename', $folders);
			$dropdownHTML = "<select name='template_folder'>";
			foreach ($templateOptions as $folder) {
				$selected = $template_folder == $folder ? " selected" : "";
				$dropdownHTML .= "<option value='$folder'$selected>$folder</option>";
			}
			$dropdownHTML .= "</select>";
			
			echo $dropdownHTML;
		?>
	
		<input name="set_template_folder" type="submit" value="Set Template Folder">
		</form>
	</fieldset>
	
	
		<!-- ------------------------- UPLOAD FONTS -->

	<?php


	$uploadDir =  "../../fonts/";

	$allowedExt = ['ttf', 'otf', 'woff', 'woff2', 'eot', 'svg'];

	if (isset($_POST['upload_font'])) {
		$fontLabel = trim($_POST['font_label'] ?? '');
		if (empty($fontLabel)) {
			$message .= "Font label is required.";
		}
		if (!isset($_FILES['font_file']) || $_FILES['font_file']['error'] !== UPLOAD_ERR_OK) {
			$message .= "No file uploaded or upload error.";
		}

		$file = $_FILES['font_file'];
		$originalName = $file['name'];
		$ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

		// Validate extension
		if (!in_array($ext, $allowedExt)) {
			$message .= "Invalid font type. Allowed: " . implode(", ", $allowedExt);
		}

		// Create safe file name
		$safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
		$newFileName = $safeName . "_" . time() . "." . $ext;

		// Move file
		if (!move_uploaded_file($file['tmp_name'], $uploadDir . $newFileName)) {
			$message .= "Failed to move uploaded file.";
		}
		
		// Insert into database
		$stmt = $conn->prepare('INSERT INTO fonts (font_label, file_name) VALUES (?, ?)');
		$stmt->bind_param('ss',	$fontLabel, $newFileName);
		$stmt->execute();
		echo "<div class='success-message'>Font '$fontLabel' uploaded successfully</div>";
		
		
	}
	
	?>

	<br>
	
	<fieldset>

		<legend>Upload Font</legend>	
		<form method="post" enctype="multipart/form-data">
			<label>Font Label:</label><br>
			<input type="text" name="font_label" required>
			<input type="file" name="font_file" required><br>
			<input name="upload_font" type="submit" value="Upload Font">
		</form>
		
		<h3>Uploaded Fonts</h2>
		<div style="padding:0 0 20px 20px;line-height:2;">
		<?php 

			$fontId = isset($_GET['fontid']) ? intval($_GET['fontid']) : 0;

			// select all fonts
			$result = $conn->query("SELECT * FROM fonts");
			while ($row = $result->fetch_assoc()) {
				if ($fontId == $row['key_fonts']) {
					unlink('../../fonts/' . $row['file_name']);
					continue; // don't print, it will be deleted next
				}
				echo "<div><a href='settings_misc.php?fontid=" . $row['key_fonts'] . "'>X</a> " . $row['font_label'] . "</div>";
			}

			// delete 'X' font
			if ($fontId > 0) {
				$conn->query("DELETE FROM fonts WHERE key_fonts = $fontId");
			}
	
		
		?>
		</div>
	</fieldset>
	
	<br>


	<!-- ------------------------- CUSTOM CSS -->

	<fieldset>
		<?php
			if (isset($_POST['set_custom_css'])) {
				$custom_css = $_POST['custom_css'];
				$sql = "UPDATE settings SET custom_css = '$custom_css' WHERE key_settings = 1";
				$conn->query($sql);
				echo "<div class='success-message'>Saved successfully.</div>";
			}
			$settings_row = $conn->query("SELECT custom_css FROM settings WHERE key_settings = 1")->fetch_assoc();
			$custom_css = $settings_row["custom_css"];

		?>
		<legend>Custom CSS</legend>	
			<form method="post">
				<textarea name="custom_css"><?= $custom_css ?></textarea>
				<input name="set_custom_css" type="submit" value="Save">
		</form>
	</fieldset>
	
	
<?php 

endLayout(); 

include_once('generate_settings_file.php');

?>