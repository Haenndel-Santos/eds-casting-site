<?php
require_once __DIR__ . '/_layout.php';
eds_cms_require_login();

$slug = eds_cms_slug($_GET['slug'] ?? $_POST['slug'] ?? '');
$path = eds_cms_project_path($slug);
$project = eds_cms_json_read($path, ['slug' => $slug, 'published' => false, 'gallery' => []]);
$message = '';
$messageType = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!eds_cms_check_csrf()) {
    $message = 'Security token expired. Please try again.';
    $messageType = 'error';
  } else {
    $gallery = eds_cms_normalize_sections($_POST['gallery'] ?? '');
    if ($gallery === null) {
      $message = 'Gallery must be valid JSON.';
      $messageType = 'error';
    } else {
      $project = [
        'slug' => $slug,
        'title' => trim((string) ($_POST['title'] ?? '')),
        'summary' => trim((string) ($_POST['summary'] ?? '')),
        'industry' => trim((string) ($_POST['industry'] ?? '')),
        'process' => trim((string) ($_POST['process'] ?? '')),
        'hero_image' => trim((string) ($_POST['hero_image'] ?? '')),
        'body' => trim((string) ($_POST['body'] ?? '')),
        'published' => !empty($_POST['published']),
        'gallery' => $gallery,
      ];
      if (eds_cms_json_write($path, $project)) {
        $message = 'Project saved.';
        $messageType = 'success';
      } else {
        $message = 'Could not save project.';
        $messageType = 'error';
      }
    }
  }
}

eds_admin_header('Edit Project');
eds_admin_flash($message, $messageType);
?>
<form class="panel form wide" method="post">
  <?php eds_admin_csrf_field(); ?>
  <input type="hidden" name="slug" value="<?php echo eds_cms_h($slug); ?>">
  <label>
    Slug
    <input type="text" value="<?php echo eds_cms_h($slug); ?>" disabled>
  </label>
  <label>
    Title
    <input type="text" name="title" value="<?php echo eds_cms_h($project['title'] ?? ''); ?>">
  </label>
  <label>
    Summary
    <textarea name="summary" rows="3"><?php echo eds_cms_h($project['summary'] ?? ''); ?></textarea>
  </label>
  <div class="columns">
    <label>
      Industry
      <input type="text" name="industry" value="<?php echo eds_cms_h($project['industry'] ?? ''); ?>">
    </label>
    <label>
      Process
      <input type="text" name="process" value="<?php echo eds_cms_h($project['process'] ?? ''); ?>">
    </label>
  </div>
  <label>
    Hero image path
    <input type="text" name="hero_image" value="<?php echo eds_cms_h($project['hero_image'] ?? ''); ?>" placeholder="/uploads/images/example.webp">
  </label>
  <label>
    Body
    <textarea name="body" rows="8"><?php echo eds_cms_h($project['body'] ?? ''); ?></textarea>
  </label>
  <label>
    Gallery JSON
    <textarea name="gallery" rows="8"><?php echo eds_cms_h(json_encode($project['gallery'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)); ?></textarea>
  </label>
  <label class="check">
    <input type="checkbox" name="published" value="1" <?php echo !empty($project['published']) ? 'checked' : ''; ?>>
    Published
  </label>
  <div class="actions">
    <button type="submit">Save project</button>
    <a class="button secondary" href="<?php echo eds_cms_public_url('/admin/projects.php'); ?>">Back</a>
  </div>
</form>
<?php eds_admin_footer(); ?>
