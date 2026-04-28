<?php
/**
 * /public_html/includes/head.php
 */

require_once __DIR__ . '/bootstrap.php';

define('SITE_URL', 'https://www.edscasting.com');

function eds_safe_segment(string $seg): string {
  $seg = strtolower(trim($seg));
  return preg_replace('/[^a-z0-9-]/', '', $seg);
}

function eds_get_path_no_query(): string {
  $uri = $_SERVER['REQUEST_URI'] ?? '/';
  $path = parse_url($uri, PHP_URL_PATH) ?: '/';
  $path = rtrim($path, '/');
  return $path === '' ? '/' : $path;
}

function eds_build_canonical(string $path): string {
  if ($path !== '/' && str_ends_with($path, '/')) {
    $path = rtrim($path, '/');
  }
  return SITE_URL . $path;
}

function eds_resolve_og_image(string $ogImage): string {
  $fallback = BASE_URL_NORM . '/assets/img/logo/logo-main.png';

  if ($ogImage === '') {
    return $fallback;
  }

  if (preg_match('/^https?:\/\//i', $ogImage)) {
    return $ogImage;
  }

  $relative = $ogImage[0] === '/' ? $ogImage : '/' . $ogImage;
  $filePath = EDS_ROOT . $relative;

  if (!is_file($filePath)) {
    return $fallback;
  }

  return $relative;
}

function eds_abs_url(string $maybeRelative): string {
  if ($maybeRelative === '') return '';
  if (preg_match('/^https?:\/\//i', $maybeRelative)) return $maybeRelative;
  if ($maybeRelative[0] !== '/') $maybeRelative = '/' . $maybeRelative;
  return SITE_URL . $maybeRelative;
}

$path = eds_get_path_no_query();

$base = BASE_URL_NORM;
if ($base !== '' && str_starts_with($path, $base)) {
  $path = substr($path, strlen($base));
  $path = rtrim($path, '/');
  if ($path === '') $path = '/';
}

$segmentsRaw = array_values(array_filter(explode('/', trim($path, '/'))));
$segments = array_map('eds_safe_segment', $segmentsRaw);

$routeAliases = [
  'terms-conditions' => 'terms',
  'terms-and-conditions' => 'terms',
];

$pageSlug = 'home';
$fallback2 = '';
$fallbackDeep = '';

if (count($segments) >= 1) {
  $last = $segments[count($segments) - 1];
  $pageSlug = $last !== '' ? $last : 'home';

  if (count($segments) >= 2) {
    $fallback2 = $segments[0] . '-' . $last;
    $fallbackDeep = implode('-', $segments);
  }
}

if (isset($routeAliases[$pageSlug])) {
  $pageSlug = $routeAliases[$pageSlug];
}

$cssDir = EDS_ROOT . '/assets/css/pages-css/';
$cssUrlBase = BASE_URL_NORM . '/assets/css/pages-css/';

$cssCandidates = [];
$cssCandidates[] = [$cssDir . $pageSlug . '.css', $cssUrlBase . $pageSlug . '.css'];
if ($fallback2) {
  $cssCandidates[] = [$cssDir . $fallback2 . '.css', $cssUrlBase . $fallback2 . '.css'];
}
if ($fallbackDeep) {
  $cssCandidates[] = [$cssDir . $fallbackDeep . '.css', $cssUrlBase . $fallbackDeep . '.css'];
}

$foundPageCssUrl = '';
$foundPageCssFile = '';

foreach ($cssCandidates as [$file, $url]) {
  if (is_file($file)) {
    $foundPageCssUrl = $url;
    $foundPageCssFile = $file;
    break;
  }
}

/* manual override when needed */
if (!empty($pageCssOverride)) {
  $foundPageCssUrl = $pageCssOverride;
}

$pageTitle = $pageTitle ?? 'EDS Casting & Forging: Precision Engineering, Casting & Forging Solutions';
$pageDescription = $pageDescription ?? 'Leading experts in precision casting & forging, providing engineering and supply chain solutions for global industries.';
$robots = $robots ?? 'index,follow';
$twitterSite = $twitterSite ?? '';

$ogImage = $ogImage ?? (BASE_URL_NORM . '/assets/img/og/eds-og-default.jpg');
$ogImage = eds_resolve_og_image($ogImage);
$ogImageAbs = eds_abs_url($ogImage);

$canonical = $canonical ?? eds_build_canonical($path);
$assetVer = $assetVer ?? '2026.02.18';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>" />
  <meta name="robots" content="<?= htmlspecialchars($robots) ?>" />

  <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>" />

  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="EDS Casting & Forging" />
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>" />
  <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>" />
  <?php if ($ogImageAbs) : ?>
    <meta property="og:image" content="<?= htmlspecialchars($ogImageAbs) ?>" />
  <?php endif; ?>

  <meta name="twitter:card" content="summary_large_image" />
  <?php if ($twitterSite) : ?>
    <meta name="twitter:site" content="<?= htmlspecialchars($twitterSite) ?>" />
  <?php endif; ?>
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>" />
  <?php if ($ogImageAbs) : ?>
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImageAbs) ?>" />
  <?php endif; ?>

  <link rel="icon" href="<?= BASE_URL_NORM ?>/assets/img/logo/favicon.png" type="image/png" />
  <link rel="shortcut icon" href="<?= BASE_URL_NORM ?>/assets/img/logo/favicon.png" type="image/png" />

  <link rel="stylesheet" href="<?= BASE_URL_NORM ?>/assets/css/style.css?v=<?= $assetVer ?>" />
  <link rel="stylesheet" href="<?= BASE_URL_NORM ?>/assets/css/components/footer-bottom-bar.css?v=<?= $assetVer ?>" />

  <?php if ($foundPageCssUrl) : ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($foundPageCssUrl) ?>?v=<?= $assetVer ?>" />
  <?php endif; ?>

  <?php foreach (($pageCssExtras ?? []) as $pageCssExtra) : ?>
    <?php
      $pageCssExtra = trim((string) $pageCssExtra);
      if ($pageCssExtra === '') continue;
      $pageCssExtraUrl = preg_match('/^https?:\/\//i', $pageCssExtra)
        ? $pageCssExtra
        : BASE_URL_NORM . '/' . ltrim($pageCssExtra, '/');
    ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($pageCssExtraUrl) ?>?v=<?= $assetVer ?>" />
  <?php endforeach; ?>

  <script src="<?= BASE_URL_NORM ?>/assets/js/header.js?v=<?= $assetVer ?>" defer></script>
  <script src="<?= BASE_URL_NORM ?>/assets/js/global.js?v=<?= $assetVer ?>" defer></script>
  <script src="<?= BASE_URL_NORM ?>/assets/js/cookies.js?v=<?= $assetVer ?>" defer></script>

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q1KDBYP4CG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-Q1KDBYP4CG');
  </script>
</head>
<body class="<?= htmlspecialchars($bodyClass ?? '', ENT_QUOTES, 'UTF-8') ?>">
