<?php
require_once __DIR__ . '/_layout.php';

$message = '';
$isSetup = !eds_cms_has_users();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!eds_cms_check_csrf()) {
    $message = 'Security token expired. Please try again.';
  } else {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($isSetup) {
      if (eds_cms_create_user($username, $password)) {
        $user = eds_cms_verify_login($username, $password);
        eds_cms_login($user);
        eds_cms_redirect('/admin/dashboard.php');
      }
      $message = 'Use a username and a password with at least 10 characters.';
    } else {
      $user = eds_cms_verify_login($username, $password);
      if ($user) {
        eds_cms_login($user);
        eds_cms_redirect('/admin/dashboard.php');
      }
      $message = 'Invalid username or password.';
    }
  }
}

eds_admin_header($isSetup ? 'Create Admin User' : 'Login');
eds_admin_flash($message, 'error');
?>
<form class="panel form" method="post">
  <?php eds_admin_csrf_field(); ?>
  <label>
    Username
    <input type="text" name="username" autocomplete="username" required>
  </label>
  <label>
    Password
    <input type="password" name="password" autocomplete="<?php echo $isSetup ? 'new-password' : 'current-password'; ?>" required>
  </label>
  <button type="submit"><?php echo $isSetup ? 'Create user' : 'Login'; ?></button>
</form>
<?php eds_admin_footer(); ?>
