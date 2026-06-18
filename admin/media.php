<?php
require_once __DIR__ . '/_layout.php';
eds_cms_require_login();

$message = '';
$messageType = 'info';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!eds_cms_check_csrf()) {
    $message = 'Security token expired. Please try again.';
    $messageType = 'error';
  } else {
    $result = eds_cms_save_upload($_FILES['file'] ?? []);
    $message = $result['ok'] ? 'Uploaded to ' . $result['path'] : $result['message'];
    $messageType = $result['ok'] ? 'success' : 'error';
  }
}

$uploads = eds_cms_list_uploads();
eds_admin_header('Media');
eds_admin_flash($message, $messageType);
?>
<section class="panel">
  <form class="inline-form" method="post" enctype="multipart/form-data">
    <?php eds_admin_csrf_field(); ?>
    <input type="file" name="file" required>
    <button type="submit">Upload</button>
  </form>
</section>
<section class="panel">
  <table>
    <thead>
      <tr><th>Name</th><th>Path</th><th>Size</th><th>Modified</th></tr>
    </thead>
    <tbody>
      <?php foreach ($uploads as $upload): ?>
        <tr>
          <td><?php echo eds_cms_h($upload['name']); ?></td>
          <td><code><?php echo eds_cms_h($upload['path']); ?></code></td>
          <td><?php echo number_format((float) $upload['size'] / 1024, 1); ?> KB</td>
          <td><?php echo date('Y-m-d H:i', $upload['modified']); ?></td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$uploads): ?>
        <tr><td colspan="4">No uploads yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
<?php eds_admin_footer(); ?>
