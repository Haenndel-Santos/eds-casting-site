<?php
// /public_html/app.php
// Clean URL resolver (local + production friendly)

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$rawPath = parse_url($requestUri, PHP_URL_PATH) ?: '/';
$path = rtrim($rawPath, '/');
if ($path === '') $path = '/';

$canonicalPath = strtolower($path);
$isSafeMethod = in_array($_SERVER['REQUEST_METHOD'] ?? 'GET', ['GET', 'HEAD'], true);
$queryString = $_SERVER['QUERY_STRING'] ?? '';

function eds_redirect_clean_path(string $targetPath, string $queryString = ''): void {
  $location = $targetPath;
  if ($queryString !== '') {
    $location .= '?' . $queryString;
  }

  header('Location: ' . $location, true, 301);
  exit;
}

$legacyRedirects = [
  '/casting' => '/casting-matrix',
  '/what-we-do' => '/eds-differentials',
  '/add-value' => '/eds-differentials',
  '/logistics' => '/eds-differentials',
  '/terms-conditions' => '/terms',
  '/terms-and-conditions' => '/terms',
];

if (isset($legacyRedirects[$canonicalPath]) && $isSafeMethod) {
  eds_redirect_clean_path($legacyRedirects[$canonicalPath], $queryString);
}

if (str_starts_with($canonicalPath, '/what-we-do/') && $isSafeMethod) {
  eds_redirect_clean_path('/eds-differentials', $queryString);
}

if ($canonicalPath !== $rawPath && $isSafeMethod) {
  eds_redirect_clean_path($canonicalPath, $queryString);
}

$path = $canonicalPath;

// HOME stays in /index.php
if ($path === '/') {
  require __DIR__ . '/index.php';
  exit;
}

// sanitize segments
$segments = array_values(array_filter(explode('/', trim($path, '/'))));
$segments = array_map(function($s){
  $s = strtolower(trim($s));
  return preg_replace('/[^a-z0-9-]/', '', $s);
}, $segments);

$slug = $segments[count($segments)-1] ?? '';
if ($slug === '') $slug = 'home';

// candidates for your current structure
$candidates = [];
$candidates[] = __DIR__ . '/pages-php/' . $slug . '.php';                   // /workflow -> pages-php/workflow.php
if (count($segments) >= 2) {
  $candidates[] = __DIR__ . '/pages-php/' . $segments[0] . '-' . $slug . '.php';
  $candidates[] = __DIR__ . '/pages-php/' . implode('-', $segments) . '.php';
}

// try resolve
$pageFile = '';
foreach ($candidates as $try) {
  if (is_file($try)) { $pageFile = $try; break; }
}

// 404
if ($pageFile === '') {
  http_response_code(404);
  include __DIR__ . '/includes/head.php';
  include __DIR__ . '/includes/header.php';
  echo '<main style="max-width:1200px;margin:0 auto;padding:60px 20px">';
  echo '<h1>Page not found</h1>';
  echo '<p>Route: <strong>' . htmlspecialchars($path) . '</strong></p>';
  echo '</main>';
  include __DIR__ . '/includes/footer.php';
  include __DIR__ . '/includes/bottombar.php';
  exit;
}

// ✅ make relative includes inside pages-php work
chdir(dirname($pageFile));
require $pageFile;
