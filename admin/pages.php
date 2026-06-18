<?php
require_once __DIR__ . '/_layout.php';
eds_cms_require_login();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!eds_cms_check_csrf()) {
    $message = 'Security token expired. Please try again.';
  } else {
    $slug = eds_cms_slug($_POST['slug'] ?? '');
    eds_cms_redirect('/admin/edit-page.php?slug=' . rawurlencode($slug));
  }
}

$pages = eds_cms_list_pages();
eds_admin_header('Pages');
eds_admin_flash($message, 'error');
?>
<section class="panel">
  <form class="inline-form" method="post">
    <?php eds_admin_csrf_field(); ?>
    <input type="text" name="slug" placeholder="new-page-slug" required>
    <button type="submit">Create or edit</button>
  </form>
</section>
<section class="panel">
  <table>
    <thead>
      <tr><th>Title</th><th>Slug</th><th>Updated</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($pages as $page): ?>
        <tr>
          <td><?php echo eds_cms_h($page['title'] ?? 'Untitled'); ?></td>
          <td><?php echo eds_cms_h($page['slug'] ?? ''); ?></td>
          <td><?php echo eds_cms_h($page['updated_at'] ?? ''); ?></td>
          <td><a class="button secondary" href="<?php echo eds_cms_public_url('/admin/edit-page.php?slug=' . rawurlencode($page['slug'] ?? '')); ?>">Edit</a></td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$pages): ?>
        <tr><td colspan="4">No pages created yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
<?php eds_admin_footer(); ?>
