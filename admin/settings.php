<?php
require_once __DIR__ . '/_layout.php';
eds_cms_require_login();

$path = eds_cms_settings_path('site');
$settings = eds_cms_json_read($path, []);
$message = '';
$messageType = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!eds_cms_check_csrf()) {
    $message = 'Security token expired. Please try again.';
    $messageType = 'error';
  } else {
    $settings = [
      'site_name' => trim((string) ($_POST['site_name'] ?? '')),
      'contact_email' => trim((string) ($_POST['contact_email'] ?? '')),
      'contact_phone' => trim((string) ($_POST['contact_phone'] ?? '')),
      'address' => trim((string) ($_POST['address'] ?? '')),
    ];
    if (eds_cms_json_write($path, $settings)) {
      $message = 'Settings saved.';
      $messageType = 'success';
    } else {
      $message = 'Could not save settings.';
      $messageType = 'error';
    }
  }
}

eds_admin_header('Settings');
eds_admin_flash($message, $messageType);
?>
<form class="panel form wide" method="post">
  <?php eds_admin_csrf_field(); ?>
  <label>
    Site name
    <input type="text" name="site_name" value="<?php echo eds_cms_h($settings['site_name'] ?? 'EDS Casting & Forging'); ?>">
  </label>
  <label>
    Contact email
    <input type="email" name="contact_email" value="<?php echo eds_cms_h($settings['contact_email'] ?? ''); ?>">
  </label>
  <label>
    Contact phone
    <input type="text" name="contact_phone" value="<?php echo eds_cms_h($settings['contact_phone'] ?? ''); ?>">
  </label>
  <label>
    Address
    <textarea name="address" rows="4"><?php echo eds_cms_h($settings['address'] ?? ''); ?></textarea>
  </label>
  <button type="submit">Save settings</button>
</form>
<?php eds_admin_footer(); ?>
