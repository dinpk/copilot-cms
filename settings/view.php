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

  <!-- General Settings -->
  <fieldset>
    <legend>🌐 General</legend>
    <input type="text" name="site_name" value="<?= $settings['site_name'] ?>" placeholder="Site Name" required><br>
    <input type="text" name="site_slogan" value="<?= $settings['site_slogan'] ?>" placeholder="Slogan"><br>
    <input type="text" name="base_url" value="<?= $settings['base_url'] ?>" placeholder="Base URL"><br>
    <input type="text" name="default_language" value="<?= $settings['default_language'] ?? '' ?>" placeholder="Default Language (e.g. en)"><br>
    <input type="text" name="timezone" value="<?= $settings['timezone'] ?? '' ?>" placeholder="Timezone (e.g. Asia/Karachi)"><br>
    <input type="text" name="admin_email" value="<?= $settings['admin_email'] ?? '' ?>" placeholder="Admin Email"><br>
  </fieldset>

  <!-- Branding -->
  <fieldset>
    <legend>🎨 Branding</legend>
    <input type="text" name="logo1_url" value="<?= $settings['logo1_url'] ?>" placeholder="Logo 1 URL"><br>
    <input type="text" name="logo2_url" value="<?= $settings['logo2_url'] ?>" placeholder="Logo 2 URL"><br>
    <input type="text" name="banner_height" value="<?= $settings['banner_height'] ?>" placeholder="Banner Height"><br>
    <textarea name="footer_content" placeholder="Footer Content"><?= $settings['footer_content'] ?></textarea><br>
    <input type="text" name="copyright_notice" value="<?= $settings['copyright_notice'] ?? '' ?>" placeholder="Copyright Notice"><br>
    <input type="text" name="powered_by" value="<?= $settings['powered_by'] ?? '' ?>" placeholder="Powered By Message"><br>
  </fieldset>

  <!-- SEO -->
  <fieldset>
    <legend>🔍 SEO</legend>
    <input type="text" name="default_meta_title" value="<?= $settings['default_meta_title'] ?? '' ?>" placeholder="Default Meta Title"><br>
    <textarea name="default_meta_desc" placeholder="Default Meta Description"><?= $settings['default_meta_desc'] ?? '' ?></textarea><br>
  </fieldset>

  <!-- Advanced -->
  <fieldset>
    <legend>⚙️ Advanced</legend>
    <input type="text" name="snippet_size" value="<?= $settings['snippet_size'] ?>" placeholder="Snippet Size"><br>
    <input type="text" name="items_on_page" value="<?= $settings['items_on_page'] ?>" placeholder="Items Per Page"><br>
    <input type="text" name="template_folder" value="<?= $settings['template_folder'] ?>" placeholder="Template Folder"><br>
    <textarea name="analytics_script" placeholder="Analytics Script"><?= $settings['analytics_script'] ?? '' ?></textarea><br>
    <textarea name="custom_css" placeholder="Custom CSS"><?= $settings['custom_css'] ?? '' ?></textarea><br>
    <textarea name="custom_js" placeholder="Custom JS"><?= $settings['custom_js'] ?? '' ?></textarea><br>
    <select name="maintenance_mode">
      <option value="0" <?= ($settings['maintenance_mode'] ?? 0) == 0 ? 'selected' : '' ?>>Live</option>
      <option value="1" <?= ($settings['maintenance_mode'] ?? 0) == 1 ? 'selected' : '' ?>>Maintenance</option>
    </select><br>
    <textarea name="maintenance_message" placeholder="Maintenance Message"><?= $settings['maintenance_message'] ?? '' ?></textarea><br>
  </fieldset>

  <input type="submit" name="update" value="Update Settings">
</form>

<?php
if (isset($_POST['update'])) {
  $stmt = $conn->prepare("UPDATE settings SET
    site_name = ?, site_slogan = ?, logo1_url = ?, logo2_url = ?, base_url = ?,
    banner_height = ?, footer_content = ?, snippet_size = ?, items_on_page = ?, template_folder = ?,
    default_language = ?, timezone = ?, admin_email = ?, maintenance_mode = ?, maintenance_message = ?,
    default_meta_title = ?, default_meta_desc = ?, analytics_script = ?, custom_css = ?, custom_js = ?,
    copyright_notice = ?, powered_by = ?
    WHERE key_settings = ?");

  $stmt->bind_param("sssssssssssssissssssssi",
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
    $_POST['default_language'],
    $_POST['timezone'],
    $_POST['admin_email'],
    $_POST['maintenance_mode'],
    $_POST['maintenance_message'],
    $_POST['default_meta_title'],
    $_POST['default_meta_desc'],
    $_POST['analytics_script'],
    $_POST['custom_css'],
    $_POST['custom_js'],
    $_POST['copyright_notice'],
    $_POST['powered_by'],
    $settings['key_settings']
  );

  $stmt->execute();
  echo "<p>✅ Settings updated successfully.</p>";
  header("Location: view.php");
  exit;
}
?>

<?php endLayout(); ?>
