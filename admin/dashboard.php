<?php
require_once __DIR__ . '/_layout.php';
eds_cms_require_login();

eds_admin_header('Dashboard');
?>
<div class="grid">
  <a class="tile" href="<?php echo eds_cms_public_url('/admin/pages.php'); ?>">
    <strong>Pages</strong>
    <span>Edit page titles, SEO fields, body text, and structured sections.</span>
  </a>
  <a class="tile" href="<?php echo eds_cms_public_url('/admin/projects.php'); ?>">
    <strong>Projects</strong>
    <span>Maintain project case content in JSON files.</span>
  </a>
  <a class="tile" href="<?php echo eds_cms_public_url('/admin/media.php'); ?>">
    <strong>Media</strong>
    <span>Upload images and documents outside the public Git repository.</span>
  </a>
  <a class="tile" href="<?php echo eds_cms_public_url('/admin/settings.php'); ?>">
    <strong>Settings</strong>
    <span>Manage editable global site settings.</span>
  </a>
</div>
<?php eds_admin_footer(); ?>
