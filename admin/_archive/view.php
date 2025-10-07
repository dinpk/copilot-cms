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
  header("Location: view.php");
  exit;
}
?>



<h2>Site Settings</h2>

<form method="post">

  <fieldset>
    <legend>🌐 General</legend>
    <input type="text" name="site_name" value="<?= $settings['site_name'] ?>" placeholder="Site Name" required maxlength="200"><br>
    <input type="text" name="site_slogan" value="<?= $settings['site_slogan'] ?>" placeholder="Slogan" maxlength="200"><br>
    <input type="url" name="base_url" value="<?= $settings['base_url'] ?>" placeholder="Base URL" maxlength="100"><br>
    <input type="text" name="default_language" value="<?= $settings['default_language'] ?? '' ?>" placeholder="Default Language (e.g. en)" maxlength="10"><br>
    <input type="text" name="timezone" value="<?= $settings['timezone'] ?? '' ?>" placeholder="Timezone (e.g. Asia/Karachi)" maxlength="50"><br>
    <input type="email" name="admin_email" value="<?= $settings['admin_email'] ?? '' ?>" placeholder="Admin Email" maxlength="200"><br>
  </fieldset>

  <fieldset>
    <legend>🎨 Branding</legend>
    <input type="url" name="logo1_url" value="<?= $settings['logo1_url'] ?>" placeholder="Logo 1 URL" maxlength="200"><br>
    <input type="url" name="logo2_url" value="<?= $settings['logo2_url'] ?>" placeholder="Logo 2 URL" maxlength="200"><br>
    <input type="text" name="banner_height" value="<?= $settings['banner_height'] ?>" placeholder="Banner Height" maxlength="5"><br>
    <textarea name="footer_content" placeholder="Footer Content" maxlength="2000"><?= $settings['footer_content'] ?></textarea><br>
    <input type="text" name="copyright_notice" value="<?= $settings['copyright_notice'] ?? '' ?>" placeholder="Copyright Notice" maxlength="300"><br>
    <input type="text" name="powered_by" value="<?= $settings['powered_by'] ?? '' ?>" placeholder="Powered By Message" maxlength="100"><br>
  </fieldset>

  <fieldset>
    <legend>🔍 SEO</legend>
    <input type="text" name="default_meta_title" value="<?= $settings['default_meta_title'] ?? '' ?>" placeholder="Default Meta Title" maxlength="300"><br>
    <textarea name="default_meta_desc" placeholder="Default Meta Description" maxlength="500"><?= $settings['default_meta_desc'] ?? '' ?></textarea><br>
  </fieldset>

  <fieldset>
    <legend>⚙️ Advanced</legend>
    <input type="number" name="snippet_size" value="<?= $settings['snippet_size'] ?>" placeholder="Snippet Size" min="0" max="999"><br>
    <input type="number" name="items_on_page" value="<?= $settings['items_on_page'] ?>" placeholder="Items Per Page" min="0" max="999"><br>
    <input type="text" name="template_folder" value="<?= $settings['template_folder'] ?>" placeholder="Template Folder" maxlength="100"><br>
    <textarea name="analytics_script" placeholder="Analytics Script"><?= $settings['analytics_script'] ?? '' ?></textarea><br>
    <textarea name="custom_css" placeholder="Custom CSS"><?= $settings['custom_css'] ?? '' ?></textarea><br>
    <textarea name="custom_js" placeholder="Custom JS"><?= $settings['custom_js'] ?? '' ?></textarea><br>
    <select name="maintenance_mode" required>
      <option value="0" <?= ($settings['maintenance_mode'] ?? 0) == 0 ? 'selected' : '' ?>>Live</option>
      <option value="1" <?= ($settings['maintenance_mode'] ?? 0) == 1 ? 'selected' : '' ?>>Maintenance</option>
    </select><br>
    <textarea name="maintenance_message" placeholder="Maintenance Message" maxlength="1000"><?= $settings['maintenance_message'] ?? '' ?></textarea><br>
  </fieldset>

  <input type="submit" name="update" value="Update Settings">
</form>



<?php endLayout(); ?>
