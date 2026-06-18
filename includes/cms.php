<?php
/**
 * Lightweight flat-file CMS helpers.
 *
 * The CMS code is tracked, while content, users, backups, and uploads stay in
 * ignored runtime folders.
 */

require_once __DIR__ . '/bootstrap.php';

if (!defined('EDS_CMS_DATA_DIR')) {
  define('EDS_CMS_DATA_DIR', EDS_ROOT . '/data');
}
if (!defined('EDS_CMS_PAGES_DIR')) {
  define('EDS_CMS_PAGES_DIR', EDS_CMS_DATA_DIR . '/pages');
}
if (!defined('EDS_CMS_PROJECTS_DIR')) {
  define('EDS_CMS_PROJECTS_DIR', EDS_CMS_DATA_DIR . '/projects');
}
if (!defined('EDS_CMS_SETTINGS_DIR')) {
  define('EDS_CMS_SETTINGS_DIR', EDS_CMS_DATA_DIR . '/settings');
}
if (!defined('EDS_CMS_BACKUP_DIR')) {
  define('EDS_CMS_BACKUP_DIR', EDS_CMS_DATA_DIR . '/backups');
}
if (!defined('EDS_CMS_UPLOADS_DIR')) {
  define('EDS_CMS_UPLOADS_DIR', EDS_ROOT . '/uploads');
}
if (!defined('EDS_CMS_MAX_UPLOAD_BYTES')) {
  define('EDS_CMS_MAX_UPLOAD_BYTES', 5 * 1024 * 1024);
}
if (!defined('EDS_CMS_SESSION_IDLE_SECONDS')) {
  define('EDS_CMS_SESSION_IDLE_SECONDS', 1800);
}
if (!defined('EDS_CMS_LOGIN_LIMIT_WINDOW_SECONDS')) {
  define('EDS_CMS_LOGIN_LIMIT_WINDOW_SECONDS', 900);
}
if (!defined('EDS_CMS_LOGIN_LIMIT_ATTEMPTS')) {
  define('EDS_CMS_LOGIN_LIMIT_ATTEMPTS', 5);
}

function eds_cms_bootstrap_storage() {
  $directories = [
    EDS_CMS_DATA_DIR,
    EDS_CMS_PAGES_DIR,
    EDS_CMS_PROJECTS_DIR,
    EDS_CMS_SETTINGS_DIR,
    EDS_CMS_BACKUP_DIR,
    EDS_CMS_UPLOADS_DIR,
    EDS_CMS_UPLOADS_DIR . '/images',
    EDS_CMS_UPLOADS_DIR . '/documents',
  ];

  foreach ($directories as $directory) {
    if (!is_dir($directory)) {
      mkdir($directory, 0755, true);
    }
  }

  eds_cms_write_once(
    EDS_CMS_DATA_DIR . '/.htaccess',
    "Options -Indexes\n<IfModule mod_authz_core.c>\n  Require all denied\n</IfModule>\n<IfModule !mod_authz_core.c>\n  Deny from all\n</IfModule>\n"
  );
  eds_cms_write_once(
    EDS_CMS_UPLOADS_DIR . '/.htaccess',
    "Options -Indexes\n<FilesMatch \"\\.(php|phtml|phar|php[0-9])$\">\n  <IfModule mod_authz_core.c>\n    Require all denied\n  </IfModule>\n  <IfModule !mod_authz_core.c>\n    Deny from all\n  </IfModule>\n</FilesMatch>\n"
  );
}

function eds_cms_write_once($path, $contents) {
  if (!file_exists($path) || file_get_contents($path) !== $contents) {
    file_put_contents($path, $contents, LOCK_EX);
  }
}

function eds_cms_start_session() {
  if (session_status() !== PHP_SESSION_ACTIVE) {
    $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
      'lifetime' => 0,
      'path' => '/',
      'secure' => $secure,
      'httponly' => true,
      'samesite' => 'Lax',
    ]);
    session_start();
  }
}

function eds_cms_slug($value) {
  $value = strtolower(trim((string) $value));
  $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
  if ($converted !== false) {
    $value = $converted;
  }
  $value = preg_replace('/[^a-z0-9]+/', '-', $value);
  $value = trim((string) $value, '-');
  return $value !== '' ? $value : 'page';
}

function eds_cms_json_read($path, array $fallback = []) {
  if (!is_file($path)) {
    return $fallback;
  }

  $contents = file_get_contents($path);
  if ($contents === false || trim($contents) === '') {
    return $fallback;
  }

  $decoded = json_decode($contents, true);
  return is_array($decoded) ? $decoded : $fallback;
}

function eds_cms_json_write($path, array $data) {
  $directory = dirname($path);
  if (!is_dir($directory)) {
    mkdir($directory, 0755, true);
  }

  if (is_file($path)) {
    $backupDirectory = EDS_CMS_BACKUP_DIR . '/' . basename($directory);
    if (!is_dir($backupDirectory)) {
      mkdir($backupDirectory, 0755, true);
    }
    $backupName = pathinfo($path, PATHINFO_FILENAME) . '-' . date('Ymd-His') . '.json';
    copy($path, $backupDirectory . '/' . $backupName);
  }

  $data['updated_at'] = gmdate('c');
  $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
  if ($json === false) {
    return false;
  }

  return file_put_contents($path, $json . "\n", LOCK_EX) !== false;
}

function eds_cms_page_path($slug) {
  return EDS_CMS_PAGES_DIR . '/' . eds_cms_slug($slug) . '.json';
}

function eds_cms_project_path($slug) {
  return EDS_CMS_PROJECTS_DIR . '/' . eds_cms_slug($slug) . '.json';
}

function eds_get_page_content($slug, array $fallback = []) {
  $content = eds_cms_json_read(eds_cms_page_path($slug), []);
  return array_replace_recursive($fallback, $content);
}

function eds_cms_set_current_page_content(array $content) {
  $GLOBALS['eds_cms_current_page_content'] = $content;
}

function eds_cms_current_page_content() {
  $content = $GLOBALS['eds_cms_current_page_content'] ?? [];
  return is_array($content) ? $content : [];
}

function eds_cms_page_value($key, $fallback = '') {
  $content = eds_cms_current_page_content();
  $value = $content[$key] ?? $fallback;
  return is_scalar($value) ? (string) $value : $fallback;
}

function eds_cms_apply_page_meta_overrides() {
  $content = eds_cms_current_page_content();
  if (!$content) {
    return;
  }

  if (!empty($content['meta_title'])) {
    $GLOBALS['pageTitle'] = (string) $content['meta_title'];
  } elseif (!empty($content['title'])) {
    $GLOBALS['pageTitle'] = (string) $content['title'] . ' | EDS Casting & Forging';
  }

  if (!empty($content['meta_description'])) {
    $GLOBALS['pageDescription'] = (string) $content['meta_description'];
  } elseif (!empty($content['subtitle'])) {
    $GLOBALS['pageDescription'] = (string) $content['subtitle'];
  }

  if (!empty($content['hero_image'])) {
    $GLOBALS['ogImage'] = (string) $content['hero_image'];
  }
}

function eds_get_project_content($slug, array $fallback = []) {
  $content = eds_cms_json_read(eds_cms_project_path($slug), []);
  return array_replace_recursive($fallback, $content);
}

function eds_cms_list_json_items($directory) {
  if (!is_dir($directory)) {
    return [];
  }

  $items = [];
  foreach (glob($directory . '/*.json') ?: [] as $path) {
    $item = eds_cms_json_read($path, []);
    $item['slug'] = $item['slug'] ?? pathinfo($path, PATHINFO_FILENAME);
    $item['_path'] = $path;
    $items[] = $item;
  }

  usort($items, function ($a, $b) {
    return strcmp((string) ($a['title'] ?? $a['slug']), (string) ($b['title'] ?? $b['slug']));
  });

  return $items;
}

function eds_cms_list_pages() {
  return eds_cms_list_json_items(EDS_CMS_PAGES_DIR);
}

function eds_cms_list_projects() {
  return eds_cms_list_json_items(EDS_CMS_PROJECTS_DIR);
}

function eds_cms_settings_path($name) {
  return EDS_CMS_SETTINGS_DIR . '/' . eds_cms_slug($name) . '.json';
}

function eds_cms_users_path() {
  return EDS_CMS_SETTINGS_DIR . '/users.json';
}

function eds_cms_users() {
  $data = eds_cms_json_read(eds_cms_users_path(), ['users' => []]);
  return isset($data['users']) && is_array($data['users']) ? $data['users'] : [];
}

function eds_cms_has_users() {
  return count(eds_cms_users()) > 0;
}

function eds_cms_create_user($username, $password, $role = 'admin') {
  $username = trim((string) $username);
  if ($username === '' || strlen((string) $password) < 10) {
    return false;
  }

  $users = eds_cms_users();
  foreach ($users as $user) {
    if (strcasecmp((string) ($user['username'] ?? ''), $username) === 0) {
      return false;
    }
  }

  $users[] = [
    'username' => $username,
    'password_hash' => password_hash((string) $password, PASSWORD_DEFAULT),
    'role' => $role,
    'created_at' => gmdate('c'),
  ];

  return eds_cms_json_write(eds_cms_users_path(), ['users' => $users]);
}

function eds_cms_verify_login($username, $password) {
  foreach (eds_cms_users() as $user) {
    if (strcasecmp((string) ($user['username'] ?? ''), trim((string) $username)) === 0) {
      if (password_verify((string) $password, (string) ($user['password_hash'] ?? ''))) {
        return $user;
      }
    }
  }

  return null;
}

function eds_cms_login($user) {
  eds_cms_start_session();
  session_regenerate_id(true);
  $_SESSION['eds_cms_user'] = [
    'username' => $user['username'] ?? '',
    'role' => $user['role'] ?? 'admin',
    'last_seen' => time(),
  ];
}

function eds_cms_logout() {
  eds_cms_start_session();
  $_SESSION = [];
  if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'] ?? '', $params['secure'], $params['httponly']);
  }
  session_destroy();
}

function eds_cms_current_user() {
  eds_cms_start_session();
  $user = $_SESSION['eds_cms_user'] ?? null;
  if (!$user || !is_array($user)) {
    return null;
  }

  $lastSeen = (int) ($user['last_seen'] ?? 0);
  if ($lastSeen > 0 && (time() - $lastSeen) > EDS_CMS_SESSION_IDLE_SECONDS) {
    eds_cms_logout();
    return null;
  }

  $_SESSION['eds_cms_user']['last_seen'] = time();
  return $_SESSION['eds_cms_user'];
}

function eds_cms_require_login() {
  if (!eds_cms_current_user()) {
    eds_cms_redirect('/admin/login.php');
  }
}

function eds_cms_csrf_token() {
  eds_cms_start_session();
  if (empty($_SESSION['eds_cms_csrf'])) {
    $_SESSION['eds_cms_csrf'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['eds_cms_csrf'];
}

function eds_cms_login_limit_key($username) {
  $username = strtolower(trim((string) $username));
  return hash('sha256', $username . '|' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
}

function eds_cms_login_is_limited($username) {
  eds_cms_start_session();
  $key = eds_cms_login_limit_key($username);
  $attempts = $_SESSION['eds_cms_login_attempts'][$key] ?? [];
  $cutoff = time() - EDS_CMS_LOGIN_LIMIT_WINDOW_SECONDS;
  $attempts = array_values(array_filter($attempts, function ($timestamp) use ($cutoff) {
    return (int) $timestamp >= $cutoff;
  }));
  $_SESSION['eds_cms_login_attempts'][$key] = $attempts;

  return count($attempts) >= EDS_CMS_LOGIN_LIMIT_ATTEMPTS;
}

function eds_cms_record_login_attempt($username, $success) {
  eds_cms_start_session();
  $key = eds_cms_login_limit_key($username);
  if ($success) {
    unset($_SESSION['eds_cms_login_attempts'][$key]);
    return;
  }

  $attempts = $_SESSION['eds_cms_login_attempts'][$key] ?? [];
  $attempts[] = time();
  $_SESSION['eds_cms_login_attempts'][$key] = $attempts;
}

function eds_cms_check_csrf() {
  eds_cms_start_session();
  $token = $_POST['_csrf'] ?? '';
  return is_string($token) && hash_equals((string) ($_SESSION['eds_cms_csrf'] ?? ''), $token);
}

function eds_cms_redirect($path) {
  $target = BASE_URL_NORM . $path;
  header('Location: ' . $target);
  exit;
}

function eds_cms_h($value) {
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function eds_cms_paragraphs($value) {
  $value = trim((string) $value);
  if ($value === '') {
    return '';
  }

  $parts = preg_split('/\R{2,}/', $value);
  $html = '';
  foreach ($parts as $part) {
    $part = trim((string) $part);
    if ($part === '') {
      continue;
    }
    $html .= '<p>' . nl2br(eds_cms_h($part), false) . '</p>';
  }

  return $html;
}

function eds_cms_public_media_url($path) {
  $path = trim((string) $path);
  if ($path === '') {
    return '';
  }

  if (preg_match('/^https?:\/\//i', $path)) {
    return $path;
  }

  if ($path[0] !== '/') {
    $path = '/' . $path;
  }

  return $path;
}

function eds_cms_public_url($path) {
  $path = '/' . ltrim((string) $path, '/');
  return BASE_URL_NORM . $path;
}

function eds_cms_normalize_sections($raw) {
  $raw = trim((string) $raw);
  if ($raw === '') {
    return [];
  }

  $decoded = json_decode($raw, true);
  return is_array($decoded) ? $decoded : null;
}

function eds_cms_allowed_upload($filename) {
  $extension = strtolower(pathinfo((string) $filename, PATHINFO_EXTENSION));
  return in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx'], true);
}

function eds_cms_allowed_mime($extension, $mime) {
  $extension = strtolower((string) $extension);
  $mime = strtolower((string) $mime);
  $allowed = [
    'jpg' => ['image/jpeg'],
    'jpeg' => ['image/jpeg'],
    'png' => ['image/png'],
    'webp' => ['image/webp'],
    'gif' => ['image/gif'],
    'pdf' => ['application/pdf'],
    'doc' => ['application/msword', 'application/octet-stream'],
    'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/octet-stream'],
    'xls' => ['application/vnd.ms-excel', 'application/octet-stream'],
    'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/octet-stream'],
  ];

  return isset($allowed[$extension]) && in_array($mime, $allowed[$extension], true);
}

function eds_cms_save_upload($file) {
  if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
    return ['ok' => false, 'message' => 'Upload failed.'];
  }
  if (($file['size'] ?? 0) > EDS_CMS_MAX_UPLOAD_BYTES) {
    return ['ok' => false, 'message' => 'File is larger than the 5 MB limit.'];
  }
  if (!eds_cms_allowed_upload($file['name'] ?? '')) {
    return ['ok' => false, 'message' => 'File type is not allowed.'];
  }

  $extension = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
  if (function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = $finfo ? finfo_file($finfo, $file['tmp_name']) : '';
    if ($finfo) {
      finfo_close($finfo);
    }
    if (!eds_cms_allowed_mime($extension, $mime)) {
      return ['ok' => false, 'message' => 'File content does not match an allowed type.'];
    }
  }

  $base = eds_cms_slug(pathinfo((string) $file['name'], PATHINFO_FILENAME));
  $folder = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true) ? 'images' : 'documents';
  $name = $base . '-' . date('Ymd-His') . '.' . $extension;
  $target = EDS_CMS_UPLOADS_DIR . '/' . $folder . '/' . $name;

  if (!move_uploaded_file($file['tmp_name'], $target)) {
    return ['ok' => false, 'message' => 'Could not move uploaded file.'];
  }

  return ['ok' => true, 'path' => '/uploads/' . $folder . '/' . $name];
}

function eds_cms_list_uploads() {
  $uploads = [];
  foreach (['images', 'documents'] as $folder) {
    foreach (glob(EDS_CMS_UPLOADS_DIR . '/' . $folder . '/*') ?: [] as $path) {
      if (is_file($path)) {
        $uploads[] = [
          'name' => basename($path),
          'path' => '/uploads/' . $folder . '/' . basename($path),
          'size' => filesize($path),
          'modified' => filemtime($path),
        ];
      }
    }
  }

  usort($uploads, function ($a, $b) {
    return ($b['modified'] ?? 0) <=> ($a['modified'] ?? 0);
  });

  return $uploads;
}

function eds_cms_render_page_blocks(array $content) {
  $body = trim((string) ($content['body'] ?? ''));
  $sections = $content['sections'] ?? [];
  if (!is_array($sections)) {
    $sections = [];
  }

  if ($body === '' && !$sections) {
    return '';
  }

  $html = '<section class="cms-page-content" id="cms-content" data-eds-cms-block>';
  $html .= '<div class="cms-page-content__inner">';

  if ($body !== '') {
    $html .= '<div class="cms-page-content__body">' . eds_cms_paragraphs($body) . '</div>';
  }

  foreach ($sections as $section) {
    if (is_string($section)) {
      $section = ['body' => $section];
    }
    if (!is_array($section)) {
      continue;
    }

    $title = trim((string) ($section['title'] ?? ''));
    $eyebrow = trim((string) ($section['eyebrow'] ?? ''));
    $sectionBody = trim((string) ($section['body'] ?? ''));
    $items = $section['items'] ?? ($section['cards'] ?? []);

    if ($title === '' && $eyebrow === '' && $sectionBody === '' && !is_array($items)) {
      continue;
    }

    $html .= '<article class="cms-page-content__section">';
    if ($eyebrow !== '') {
      $html .= '<p class="cms-page-content__eyebrow">' . eds_cms_h($eyebrow) . '</p>';
    }
    if ($title !== '') {
      $html .= '<h2>' . eds_cms_h($title) . '</h2>';
    }
    if ($sectionBody !== '') {
      $html .= eds_cms_paragraphs($sectionBody);
    }

    if (is_array($items) && $items) {
      $html .= '<div class="cms-page-content__cards">';
      foreach ($items as $item) {
        if (is_string($item)) {
          $item = ['body' => $item];
        }
        if (!is_array($item)) {
          continue;
        }

        $itemTitle = trim((string) ($item['title'] ?? ''));
        $itemBody = trim((string) ($item['body'] ?? $item['text'] ?? ''));
        if ($itemTitle === '' && $itemBody === '') {
          continue;
        }

        $html .= '<div class="cms-page-content__card">';
        if ($itemTitle !== '') {
          $html .= '<h3>' . eds_cms_h($itemTitle) . '</h3>';
        }
        if ($itemBody !== '') {
          $html .= eds_cms_paragraphs($itemBody);
        }
        $html .= '</div>';
      }
      $html .= '</div>';
    }

    $html .= '</article>';
  }

  $html .= '</div></section>';
  return $html;
}

function eds_cms_filter_public_html($html, array $content) {
  if (!$content || !is_string($html) || $html === '') {
    return $html;
  }

  $title = trim((string) ($content['title'] ?? ''));
  if ($title !== '') {
    $html = preg_replace('/<h1\b([^>]*)>.*?<\/h1>/is', '<h1$1>' . eds_cms_h($title) . '</h1>', $html, 1);
  }

  $subtitle = trim((string) ($content['subtitle'] ?? ''));
  if ($subtitle !== '') {
    $subtitleHtml = nl2br(eds_cms_h($subtitle), false);
    $updated = preg_replace(
      '/<p\b([^>]*class="[^"]*(?:process-hero__summary|home-hero__summary)[^"]*"[^>]*)>.*?<\/p>/is',
      '<p$1>' . $subtitleHtml . '</p>',
      $html,
      1,
      $count
    );

    if ($count > 0) {
      $html = $updated;
    } else {
      $html = preg_replace(
        '/(<section\b[^>]*class="[^"]*(?:about-hero|contact-hero)[^"]*"[\s\S]*?<p\b[^>]*>)[\s\S]*?(<\/p>)/i',
        '$1' . $subtitleHtml . '$2',
        $html,
        1
      );
    }
  }

  $heroImage = eds_cms_public_media_url($content['hero_image'] ?? '');
  if ($heroImage !== '') {
    $styleUrl = str_replace("'", '%27', $heroImage);
    $updated = preg_replace(
      '/background-image:\s*url\((["\']?)[^"\')]+\\1\);/i',
      "background-image: url('" . $styleUrl . "');",
      $html,
      1,
      $count
    );

    if ($count > 0) {
      $html = $updated;
    } else {
      $html = preg_replace(
        '/(<div\b[^>]*class="[^"]*home-hero__media[^"]*"[\s\S]*?<img\b[^>]*\bsrc=")[^"]*(")/i',
        '$1' . eds_cms_h($heroImage) . '$2',
        $html,
        1
      );
    }
  }

  $block = eds_cms_render_page_blocks($content);
  if ($block !== '' && strpos($html, 'data-eds-cms-block') === false) {
    $updated = preg_replace('/(<div\b[^>]*class="[^"]*process-content[^"]*"[^>]*>)/i', $block . '$1', $html, 1, $count);
    if ($count > 0) {
      $html = $updated;
    } else {
      $html = preg_replace('/<\/main>/i', $block . '</main>', $html, 1);
    }
  }

  return $html;
}

function eds_cms_start_public_page_filter(array $content) {
  if (headers_sent() || !$content) {
    return;
  }

  ob_start(function ($html) use ($content) {
    return eds_cms_filter_public_html($html, $content);
  });
}
