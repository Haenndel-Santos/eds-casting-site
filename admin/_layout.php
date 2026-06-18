<?php
require_once __DIR__ . '/_bootstrap.php';

function eds_admin_header($title) {
  $user = eds_cms_current_user();
  ?>
  <!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title><?php echo eds_cms_h($title); ?> | EDS Admin</title>
    <link rel="stylesheet" href="<?php echo eds_cms_public_url('/admin/assets/admin.css'); ?>">
  </head>
  <body>
    <header class="topbar">
      <a class="brand" href="<?php echo eds_cms_public_url('/admin/dashboard.php'); ?>">EDS Admin</a>
      <?php if ($user): ?>
        <nav class="nav">
          <a href="<?php echo eds_cms_public_url('/admin/pages.php'); ?>">Pages</a>
          <a href="<?php echo eds_cms_public_url('/admin/projects.php'); ?>">Projects</a>
          <a href="<?php echo eds_cms_public_url('/admin/media.php'); ?>">Media</a>
          <a href="<?php echo eds_cms_public_url('/admin/settings.php'); ?>">Settings</a>
          <a href="<?php echo eds_cms_public_url('/admin/users.php'); ?>">Users</a>
          <a href="<?php echo eds_cms_public_url('/admin/logout.php'); ?>">Logout</a>
        </nav>
      <?php endif; ?>
    </header>
    <main class="shell">
      <h1><?php echo eds_cms_h($title); ?></h1>
  <?php
}

function eds_admin_footer() {
  ?>
    </main>
  </body>
  </html>
  <?php
}

function eds_admin_flash($message, $type = 'info') {
  if ($message === '') {
    return;
  }
  echo '<div class="notice notice-' . eds_cms_h($type) . '">' . eds_cms_h($message) . '</div>';
}

function eds_admin_csrf_field() {
  echo '<input type="hidden" name="_csrf" value="' . eds_cms_h(eds_cms_csrf_token()) . '">';
}
