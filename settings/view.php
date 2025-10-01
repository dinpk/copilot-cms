<?php 
include '../db.php';
include '../layout.php'; 
include '../users/auth.php'; 
?>


<?php startLayout("Site Settings"); ?>

<?php
$sql = "SELECT * FROM settings LIMIT 1";
$result = $conn->query($sql);
$settings = $result->fetch_assoc();
?>

<h2>Site Settings</h2>

<form method="post">
  <input type="text" name="site_name" value="<?= $settings['site_name'] ?>" placeholder="Site Name" required><br>
  <input type="text" name="site_slogan" value="<?= $settings['site_slogan'] ?>" placeholder="Slogan"><br>
  <input type="text" name="logo1_url" value="<?= $settings['logo1_url'] ?>" placeholder="Logo 1 URL"><br>
  <input type="text" name="logo2_url" value="<?= $settings['logo2_url'] ?>" placeholder="Logo 2 URL"><br>
  <input type="text" name="base_url" value="<?= $settings['base_url'] ?>" placeholder="Base URL"><br>
  <input type="text" name="banner_height" value="<?= $settings['banner_height'] ?>" placeholder="Banner Height"><br>
  <textarea name="footer_content" placeholder="Footer Content"><?= $settings['footer_content'] ?></textarea><br>
  <input type="text" name="snippet_size" value="<?= $settings['snippet_size'] ?>" placeholder="Snippet Size"><br>
  <input type="text" name="items_on_page" value="<?= $settings['items_on_page'] ?>" placeholder="Items Per Page"><br>
  <input type="text" name="template_folder" value="<?= $settings['template_folder'] ?>" placeholder="Template Folder"><br>
  <input type="submit" name="update" value="Update Settings">
</form>

<?php
if (isset($_POST['update'])) {
  $stmt = $conn->prepare("UPDATE settings SET
    site_name = ?, site_slogan = ?, logo1_url = ?, logo2_url = ?, base_url = ?,
    banner_height = ?, footer_content = ?, snippet_size = ?, items_on_page = ?, template_folder = ?
    WHERE key_settings = ?");

  $stmt->bind_param("ssssssssssi",
    $_POST['site_name'],
    $_POST['site_slogan'],
    $_POST['logo1_url'],
    $_POST['logo2_url'],
    $_POST['base_url'],
    $_POST['banner_height'],
    $_POST['footer_content'],
    $_POST['snippet_size'],
    $_POST['items_on_page'],
    $_POST['template_folder'],
    $settings['key_settings']
  );

  $stmt->execute();
  echo "<p>✅ Settings updated successfully.</p>";
}
?>

<?php endLayout(); ?>
