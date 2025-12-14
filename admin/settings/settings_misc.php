<?php 
include_once('../../dbconnection.php');
include_once('../functions.php');
include_once('../users/auth.php');
include_once('../layout.php'); 
?>

<?php startLayout("Settings Misc"); ?>


<?php

$message = '';

if (isset($_POST['save_submit'])) {


	$cache_folder = "../../cache";

	if (isset($_POST["home"])) {
		$file_hash = md5("/home");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["articles"])) {
		$file_hash = md5("/articles");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["content_types"])) {
		$file_hash = md5("/content-types");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["categories"])) {
		$file_hash = md5("/categories");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["tags"])) {
		$file_hash = md5("/tags");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["pages"])) {
		$file_hash = md5("/pages");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["authors"])) {
		$file_hash = md5("/authors");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["books"])) {
		$file_hash = md5("/books");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["photo_gallery"])) {
		$file_hash = md5("/photo-gallery");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["youtube_gallery"])) {
		$file_hash = md5("/youtube-gallery");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["users"])) {
		$file_hash = md5("/users");
		$cache_file = str_replace("//", "/", "$cache_folder/$file_hash");
		if (file_exists($cache_file)) unlink($cache_file);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}




	if (isset($_POST["all"])) {
		$files = glob($cache_folder . '/*');
		if (array_walk($files, function ($file) {unlink($file);})) {
			$message = "<div class='success-result'>Cache cleared successfully</div>";
		} else {
			$message = "<div class='failure-result'>Some error occured, could not clear cache</div>";
		}
	}
		
}

if (!empty($message)) echo "<div class='success-message'>$message</div>";

?>
	
	<br>

	<fieldset>
		<legend>Clear Cache</legend>
		<form method='post'>
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
		<input name='save_submit' type='submit' value='Clear Cache'>
		</form>	
	</fieldset>
		
	



<?php endLayout(); ?>