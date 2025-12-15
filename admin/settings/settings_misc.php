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


	$cacheFolder = "../../cache";

	if (isset($_POST["home"])) {
		$fileHash = md5("home");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["articles"])) {
		$fileHash = md5("articles");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["content_types"])) {
		$fileHash = md5("content-types");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["categories"])) {
		$fileHash = md5("categories");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["tags"])) {
		$fileHash = md5("tags");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["pages"])) {
		$fileHash = md5("pages");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["authors"])) {
		$fileHash = md5("authors");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["books"])) {
		$fileHash = md5("books");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["photo_gallery"])) {
		$fileHash = md5("photo-gallery");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["youtube_gallery"])) {
		$fileHash = md5("youtube-gallery");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}

	if (isset($_POST["users"])) {
		$fileHash = md5("users");
		$cacheFile = "$cacheFolder/$fileHash";
		if (file_exists($cacheFile)) unlink($cacheFile);
		$message = "<div class='success-result'>Cache cleared successfully</div>";
	}




	if (isset($_POST["all"])) {
		$files = glob($cacheFolder . '/*');
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