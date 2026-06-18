<?php
require_once __DIR__ . '/_layout.php';
eds_cms_require_login();

$slug = eds_cms_slug($_GET['slug'] ?? $_POST['slug'] ?? '');
$path = eds_cms_page_path($slug);
$page = eds_cms_json_read($path, ['slug' => $slug, 'sections' => []]);
$message = '';
$messageType = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!eds_cms_check_csrf()) {
    $message = 'Security token expired. Please try again.';
    $messageType = 'error';
  } else {
    $sections = eds_cms_normalize_sections($_POST['sections'] ?? '');
    if ($sections === null) {
      $message = 'Sections must be valid JSON.';
      $messageType = 'error';
    } else {
      $page = [
        'slug' => $slug,
        'title' => trim((string) ($_POST['title'] ?? '')),
        'subtitle' => trim((string) ($_POST['subtitle'] ?? '')),
        'meta_title' => trim((string) ($_POST['meta_title'] ?? '')),
        'meta_description' => trim((string) ($_POST['meta_description'] ?? '')),
        'hero_image' => trim((string) ($_POST['hero_image'] ?? '')),
        'body' => trim((string) ($_POST['body'] ?? '')),
        'sections' => $sections,
      ];
      if (eds_cms_json_write($path, $page)) {
        $message = 'Page saved.';
        $messageType = 'success';
      } else {
        $message = 'Could not save page.';
        $messageType = 'error';
      }
    }
  }
}

eds_admin_header('Edit Page');
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
    <input type="text" name="title" value="<?php echo eds_cms_h($page['title'] ?? ''); ?>">
  </label>
  <label>
    Subtitle
    <input type="text" name="subtitle" value="<?php echo eds_cms_h($page['subtitle'] ?? ''); ?>">
  </label>
  <label>
    Meta title
    <input type="text" name="meta_title" value="<?php echo eds_cms_h($page['meta_title'] ?? ''); ?>">
  </label>
  <label>
    Meta description
    <textarea name="meta_description" rows="3"><?php echo eds_cms_h($page['meta_description'] ?? ''); ?></textarea>
  </label>
  <label>
    Hero image path
    <input type="text" name="hero_image" value="<?php echo eds_cms_h($page['hero_image'] ?? ''); ?>" placeholder="/uploads/images/example.webp">
  </label>
  <label>
    Body
    <textarea name="body" rows="8"><?php echo eds_cms_h($page['body'] ?? ''); ?></textarea>
  </label>
  <label>
    Sections JSON
    <textarea name="sections" rows="12"><?php echo eds_cms_h(json_encode($page['sections'] ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)); ?></textarea>
  </label>
  <div class="actions">
    <button type="submit">Save page</button>
    <a class="button secondary" href="<?php echo eds_cms_public_url('/admin/pages.php'); ?>">Back</a>
  </div>
</form>
<?php eds_admin_footer(); ?>
