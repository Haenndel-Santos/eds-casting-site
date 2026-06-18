<?php
require_once __DIR__ . '/_layout.php';
eds_cms_require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && eds_cms_check_csrf()) {
  $slug = eds_cms_slug($_POST['slug'] ?? '');
  eds_cms_redirect('/admin/edit-project.php?slug=' . rawurlencode($slug));
}

$projects = eds_cms_list_projects();
eds_admin_header('Projects');
?>
<section class="panel">
  <form class="inline-form" method="post">
    <?php eds_admin_csrf_field(); ?>
    <input type="text" name="slug" placeholder="new-project-slug" required>
    <button type="submit">Create or edit</button>
  </form>
</section>
<section class="panel">
  <table>
    <thead>
      <tr><th>Title</th><th>Slug</th><th>Status</th><th>Updated</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($projects as $project): ?>
        <tr>
          <td><?php echo eds_cms_h($project['title'] ?? 'Untitled'); ?></td>
          <td><?php echo eds_cms_h($project['slug'] ?? ''); ?></td>
          <td><?php echo !empty($project['published']) ? 'Published' : 'Draft'; ?></td>
          <td><?php echo eds_cms_h($project['updated_at'] ?? ''); ?></td>
          <td><a class="button secondary" href="<?php echo eds_cms_public_url('/admin/edit-project.php?slug=' . rawurlencode($project['slug'] ?? '')); ?>">Edit</a></td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$projects): ?>
        <tr><td colspan="5">No projects created yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
<?php eds_admin_footer(); ?>
