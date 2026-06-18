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
    $created = eds_cms_create_user($_POST['username'] ?? '', $_POST['password'] ?? '');
    $message = $created ? 'User created.' : 'Could not create user. Use a unique username and a password with at least 10 characters.';
    $messageType = $created ? 'success' : 'error';
  }
}

$users = eds_cms_users();
eds_admin_header('Users');
eds_admin_flash($message, $messageType);
?>
<section class="panel">
  <form class="inline-form" method="post">
    <?php eds_admin_csrf_field(); ?>
    <input type="text" name="username" placeholder="username" required>
    <input type="password" name="password" placeholder="password" required>
    <button type="submit">Add user</button>
  </form>
</section>
<section class="panel">
  <table>
    <thead>
      <tr><th>Username</th><th>Role</th><th>Created</th></tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?php echo eds_cms_h($user['username'] ?? ''); ?></td>
          <td><?php echo eds_cms_h($user['role'] ?? 'admin'); ?></td>
          <td><?php echo eds_cms_h($user['created_at'] ?? ''); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
<?php eds_admin_footer(); ?>
