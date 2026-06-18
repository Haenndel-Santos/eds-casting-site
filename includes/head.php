<?php
/**
 * /public_html/includes/head.php
 *
 * Global <head> template for EDS Casting & Forging.
 *
 * Purpose:
 * - Resolve page slug from the current URL.
 * - Load global CSS in a predictable order.
 * - Load shared main-pages.css only where it is really needed.
 * - Load the correct page-specific CSS from /assets/css/pages-css/.
 * - Keep isolated pages independent from main-pages.css.
 * - Output SEO metadata, social metadata, schema, tracking and global scripts.
 *
 * Important isolated pages:
 * - /eds-differentials loads /assets/css/pages-css/eds-differentials.css only.
 * - /industries-partners loads /assets/css/pages-css/industries-partners.css only.
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/cms.php';

if (!defined('SITE_URL')) {
  define('SITE_URL', 'https://www.edscasting.com');
}

if (!function_exists('eds_safe_segment')) {
  function eds_safe_segment(string $seg): string {
    $seg = strtolower(trim($seg));
    return preg_replace('/[^a-z0-9-]/', '', $seg) ?: '';
  }
}

if (!function_exists('eds_get_path_no_query')) {
  function eds_get_path_no_query(): string {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($uri, PHP_URL_PATH) ?: '/';
    $path = rtrim($path, '/');

    return $path === '' ? '/' : $path;
  }
}

if (!function_exists('eds_build_canonical')) {
  function eds_build_canonical(string $path): string {
    $path = trim($path);

    if ($path === '') {
      $path = '/';
    }

    if ($path[0] !== '/') {
      $path = '/' . $path;
    }

    if ($path !== '/' && str_ends_with($path, '/')) {
      $path = rtrim($path, '/');
    }

    return SITE_URL . $path;
  }
}

if (!function_exists('eds_abs_url')) {
  function eds_abs_url(string $maybeRelative): string {
    $maybeRelative = trim($maybeRelative);

    if ($maybeRelative === '') {
      return '';
    }

    if (preg_match('/^https?:\/\//i', $maybeRelative)) {
      return $maybeRelative;
    }

    if ($maybeRelative[0] !== '/') {
      $maybeRelative = '/' . $maybeRelative;
    }

    return SITE_URL . $maybeRelative;
  }
}

if (!function_exists('eds_resolve_og_image')) {
  function eds_resolve_og_image(string $ogImage): string {
    $fallback = BASE_URL_NORM . '/assets/img/hero-img/eng-hero.webp';
    $ogImage = trim($ogImage);

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
}

if (!function_exists('eds_resolve_css_url')) {
  function eds_resolve_css_url(string $cssRef, string $cssUrlBase): string {
    $cssRef = trim($cssRef);

    if ($cssRef === '') {
      return '';
    }

    if (preg_match('/^https?:\/\//i', $cssRef)) {
      return $cssRef;
    }

    if (str_ends_with($cssRef, '.css')) {
      if ($cssRef[0] === '/') {
        return BASE_URL_NORM . $cssRef;
      }

      if (str_contains($cssRef, '/')) {
        return BASE_URL_NORM . '/' . ltrim($cssRef, '/');
      }

      return $cssUrlBase . basename($cssRef);
    }

    if (str_contains($cssRef, '/')) {
      return BASE_URL_NORM . '/' . ltrim($cssRef, '/');
    }

    $safeCssRef = eds_safe_segment($cssRef);

    return $safeCssRef !== '' ? $cssUrlBase . $safeCssRef . '.css' : '';
  }
}

/* ---------------------------------------------------------
   Route detection
--------------------------------------------------------- */

$path = eds_get_path_no_query();
$base = defined('BASE_URL_NORM') ? BASE_URL_NORM : '';

if ($base !== '' && $base !== '/' && str_starts_with($path, $base)) {
  $path = substr($path, strlen($base));
  $path = rtrim($path, '/');

  if ($path === '') {
    $path = '/';
  }
}

$segmentsRaw = array_values(array_filter(explode('/', trim($path, '/'))));
$segments = array_map('eds_safe_segment', $segmentsRaw);

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

/* ---------------------------------------------------------
   CSS route resolution
--------------------------------------------------------- */

$cssDir = EDS_ROOT . '/assets/css/pages-css/';
$cssUrlBase = BASE_URL_NORM . '/assets/css/pages-css/';

/*
 * CSS-only aliases.
 * Do not overwrite $pageSlug here.
 */
$cssRouteAliases = [
  'terms-conditions' => 'terms',
  'terms-and-conditions' => 'terms',
  'privacy' => 'terms',
  'disclaimer' => 'terms',

  /* Explicit aliases for clarity and consistency. */
  'eds-differentials' => 'eds-differentials',
  'industries-partners' => 'industries-partners',
];

$cssSlug = $cssRouteAliases[$pageSlug] ?? $pageSlug;

$cssCandidates = [
  [$cssDir . $cssSlug . '.css', $cssUrlBase . $cssSlug . '.css'],
];

if ($fallback2) {
  $fallback2Css = $cssRouteAliases[$fallback2] ?? $fallback2;
  $cssCandidates[] = [$cssDir . $fallback2Css . '.css', $cssUrlBase . $fallback2Css . '.css'];
}

if ($fallbackDeep) {
  $fallbackDeepCss = $cssRouteAliases[$fallbackDeep] ?? $fallbackDeep;
  $cssCandidates[] = [$cssDir . $fallbackDeepCss . '.css', $cssUrlBase . $fallbackDeepCss . '.css'];
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

/*
 * Hard routing for isolated pages.
 * This guarantees the expected CSS URL even if a filesystem path mismatch occurs.
 */
if ($pageSlug === 'eds-differentials') {
  $foundPageCssUrl = $cssUrlBase . 'eds-differentials.css';
  $foundPageCssFile = $cssDir . 'eds-differentials.css';
}

if ($pageSlug === 'industries-partners') {
  $foundPageCssUrl = $cssUrlBase . 'industries-partners.css';
  $foundPageCssFile = $cssDir . 'industries-partners.css';
}

/*
 * Optional page-level CSS override.
 * Use one of these before including head.php when needed:
 * $pageCss = 'industries-partners';
 * $pageCssOverride = '/assets/css/pages-css/custom-file.css';
 */
if (!empty($pageCss)) {
  $resolvedPageCss = eds_resolve_css_url((string) $pageCss, $cssUrlBase);

  if ($resolvedPageCss !== '') {
    $foundPageCssUrl = $resolvedPageCss;
  }
}

if (!empty($pageCssOverride)) {
  $resolvedPageCssOverride = eds_resolve_css_url((string) $pageCssOverride, $cssUrlBase);

  if ($resolvedPageCssOverride !== '') {
    $foundPageCssUrl = $resolvedPageCssOverride;
  }
}

/* ---------------------------------------------------------
   Shared main-pages.css control
--------------------------------------------------------- */

$mainPagesCssSlugs = [
  // Main process pages
  'casting-matrix',
  'forging',

  // Casting pages
  'sand-casting',
  'shell-moulding',
  'investment',
  'gravity-die',
  'high-pressure-die',
  'lost-foam',
  'sintering',

  // Forging pages
  'closed-die',
  'open-die',
  'rolled-ring',
  'multi-directional',

  // Add Value pages
  'machining',
  'assemblies',
  'surface-finishing',
  'sand-print3d',
  'printed-cores-3d',

  // Logistics pages
  'supply-chain',
  'warehousing',

  // General pages using the shared process-page pattern
  'careers',
  'vacancies',
  'contact',
  'faq',
  'quality',
  'original-parts',
  'workflow',
];

$mainPagesCssFile = $cssDir . 'main-pages.css';
$mainPagesCssUrl = $cssUrlBase . 'main-pages.css';

$loadMainPagesCss = in_array($pageSlug, $mainPagesCssSlugs, true);

/* Optional per-page override. */
if (isset($useMainPagesCss)) {
  $loadMainPagesCss = (bool) $useMainPagesCss;
}

/*
 * Isolated page CSS rules.
 * These pages must not load main-pages.css, even if a page accidentally sets
 * $useMainPagesCss = true before including head.php.
 */
$isolatedPageCssSlugs = [
  'eds-differentials',
  'industries-partners',
];

if (in_array($pageSlug, $isolatedPageCssSlugs, true)) {
  $loadMainPagesCss = false;
}

if (!is_file($mainPagesCssFile)) {
  $loadMainPagesCss = false;
}

/* ---------------------------------------------------------
   SEO defaults
--------------------------------------------------------- */

$pageTitle = $pageTitle ?? 'EDS Casting & Forging: Precision Engineering, Casting & Forging Solutions';
$pageDescription = $pageDescription ?? 'Leading experts in precision casting & forging, providing engineering and supply chain solutions for global industries.';
$robots = $robots ?? 'index,follow';
$twitterSite = $twitterSite ?? '';

$headCmsContent = eds_cms_current_page_content();
if (!$headCmsContent) {
  $headCmsContent = eds_get_page_content($pageSlug, []);
  eds_cms_set_current_page_content($headCmsContent);
}
eds_cms_apply_page_meta_overrides();

$pageTitle = $GLOBALS['pageTitle'] ?? $pageTitle;
$pageDescription = $GLOBALS['pageDescription'] ?? $pageDescription;

$ogImage = $ogImage ?? (BASE_URL_NORM . '/assets/img/hero-img/eng-hero.webp');
$ogImage = eds_resolve_og_image((string) $ogImage);
$ogImageAbs = eds_abs_url($ogImage);

if (!isset($canonical)) {
  $canonical = !empty($canonicalPath)
    ? eds_build_canonical((string) $canonicalPath)
    : eds_build_canonical($path);
}

/* Update this when replacing CSS/JS during tests to bypass browser cache. */
$assetVer = $assetVer ?? ($assetVersion ?? '2026.06.17.1');

/* ---------------------------------------------------------
   Critical image preload
--------------------------------------------------------- */

$criticalImage = $criticalImage ?? '';

if ($criticalImage === '' && $pageSlug === 'home') {
  $criticalImage = BASE_URL_NORM . '/assets/img/hero-img/eng-hero.webp';
}

$heroPreloadBySlug = [
  'about-us' => '/assets/img/hero/about-us-hero1-optimized.webp',
  'assemblies' => '/assets/img/hero/assemb-optimized.webp',
  'careers' => '/assets/img/hero/careers-optimized.webp',
  'casting-matrix' => '/assets/img/hero/casting-matrix-optimized.webp',
  'closed-die' => '/assets/img/hero/closed-die-optimized.webp',
  'contact' => '/assets/img/hero/contact-optimized.webp',
  'eds-differentials' => '/assets/img/hero/dif-hero-optimized.webp',
  'faq' => '/assets/img/hero/faq-optimized.webp',
  'forging' => '/assets/img/hero/forging-optimized.webp',
  'gravity-die' => '/assets/img/hero/gravitydie1-optimized.webp',
  'high-pressure-die' => '/assets/img/hero/highpressure-optimized.webp',
  'industries-partners' => '/assets/img/hero/industries-optimized.webp',
  'investment' => '/assets/img/hero/investment-optimized.webp',
  'lost-foam' => '/assets/img/hero/lostfoameds-optimized.webp',
  'machining' => '/assets/img/hero/machining-optimized.webp',
  'multi-directional' => '/assets/img/hero/multidir-optimized.webp',
  'open-die' => '/assets/img/hero/open-die-optimized.webp',
  'original-parts' => '/assets/img/hero/original-parts-optimized.webp',
  'our-team' => '/assets/img/hero/our-team-optimized.webp',
  'printed-cores-3d' => '/assets/img/hero/3dcores-optimized.webp',
  'projects' => '/assets/img/hero/projects-optimized.webp',
  'quality' => '/assets/img/hero/quality-optimized.webp',
  'rolled-ring' => '/assets/img/hero/rolledring-optimized.webp',
  'sand-casting' => '/assets/img/hero/sandcast-optimized.webp',
  'sand-print3d' => '/assets/img/hero/3dsand-optimized.webp',
  'shell-moulding' => '/assets/img/hero/shellmoulding-optimized.webp',
  'sintering' => '/assets/img/hero/sintering-optimized.webp',
  'supply-chain' => '/assets/img/hero/supply-optimized.webp',
  'surface-finishing' => '/assets/img/hero/surface-optimized.webp',
  'vacancies' => '/assets/img/hero/careers-optimized.webp',
  'warehousing' => '/assets/img/hero/warehousing-optimized.webp',
  'workflow' => '/assets/img/hero/workflow-optimized.webp',
];

if ($criticalImage === '' && isset($heroPreloadBySlug[$pageSlug])) {
  $criticalImage = BASE_URL_NORM . $heroPreloadBySlug[$pageSlug];
}

/* Extra guarantees for isolated page hero preloads. */
if ($pageSlug === 'eds-differentials') {
  $criticalImage = BASE_URL_NORM . '/assets/img/hero/dif-hero-optimized.webp';
}

if ($pageSlug === 'industries-partners') {
  $criticalImage = BASE_URL_NORM . '/assets/img/hero/industries-optimized.webp';
}

/* ---------------------------------------------------------
   Global CSS files
--------------------------------------------------------- */

$legacySectionCssSlugs = [
  'disclaimer',
  'privacy',
  'terms',
  'terms-conditions',
  'terms-and-conditions',
];

$globalCssFiles = [
  '/assets/css/colors.css',
  '/assets/css/_base.css',
  '/assets/css/global-overrides.css',
  '/assets/css/components/header.css',
  '/assets/css/components/menu-overlay.css',
  '/assets/css/components/cookies-banner.css',
  '/assets/css/components/footer-bottom-bar.css',
  '/assets/css/components/cms-content.css',
  '/assets/css/darkmode.css',
  '/assets/css/responsive.css',
];

$commercialCssSlugs = [
  'home',
  'workflow',
  'projects',
  'industries-partners',
  'quality',
  'contact',
];

if (in_array($pageSlug, $commercialCssSlugs, true)) {
  $globalCssFiles[] = '/assets/css/components/eds-commercial.css';
}

if (in_array($pageSlug, $legacySectionCssSlugs, true)) {
  $globalCssFiles[] = '/assets/css/sections.css';
}

/* ---------------------------------------------------------
   Structured data
--------------------------------------------------------- */

$edsOrganizationSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'Organization',
  'name' => 'EDS Casting & Forging B.V.',
  'url' => SITE_URL,
  'logo' => SITE_URL . '/assets/img/logo/logo-main.png',
  'description' => 'EDS Casting & Forging B.V. supports industrial customers with engineering-driven sourcing, supplier coordination and quality follow-up for cast and forged metal components.',
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => 'Keienbergweg 95',
    'addressLocality' => 'Amsterdam',
    'postalCode' => '1101 GE',
    'addressCountry' => 'NL',
  ],
  'contactPoint' => [
    '@type' => 'ContactPoint',
    'telephone' => '+31 20 358 5066',
    'email' => 'info@edsinnovation.com',
    'contactType' => 'sales',
    'areaServed' => 'Europe',
    'availableLanguage' => ['English', 'Dutch'],
  ],
];

$edsWebsiteSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'WebSite',
  'name' => 'EDS Casting & Forging',
  'url' => SITE_URL,
  'description' => 'Engineering-driven sourcing, supplier coordination and quality support for cast and forged industrial components.',
];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>" />
  <meta name="robots" content="<?= htmlspecialchars($robots, ENT_QUOTES, 'UTF-8') ?>" />

  <link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" />

  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="EDS Casting & Forging" />
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>" />
  <meta property="og:url" content="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>" />
  <?php if ($ogImageAbs) : ?>
    <meta property="og:image" content="<?= htmlspecialchars($ogImageAbs, ENT_QUOTES, 'UTF-8') ?>" />
  <?php endif; ?>

  <meta name="twitter:card" content="summary_large_image" />
  <?php if ($twitterSite) : ?>
    <meta name="twitter:site" content="<?= htmlspecialchars($twitterSite, ENT_QUOTES, 'UTF-8') ?>" />
  <?php endif; ?>
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>" />
  <?php if ($ogImageAbs) : ?>
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImageAbs, ENT_QUOTES, 'UTF-8') ?>" />
  <?php endif; ?>

  <link rel="icon" href="<?= BASE_URL_NORM ?>/assets/img/logo/favicon.png" type="image/png" />
  <link rel="shortcut icon" href="<?= BASE_URL_NORM ?>/assets/img/logo/favicon.png" type="image/png" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" />

  <?php if ($criticalImage) : ?>
    <link rel="preload" as="image" href="<?= htmlspecialchars($criticalImage, ENT_QUOTES, 'UTF-8') ?>" fetchpriority="high" />
  <?php endif; ?>

  <?php foreach ($globalCssFiles as $globalCssFile) : ?>
    <link rel="stylesheet" href="<?= BASE_URL_NORM . $globalCssFile ?>?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" />
  <?php endforeach; ?>

  <?php if ($loadMainPagesCss) : ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($mainPagesCssUrl, ENT_QUOTES, 'UTF-8') ?>?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" />
  <?php endif; ?>

  <?php if ($foundPageCssUrl) : ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($foundPageCssUrl, ENT_QUOTES, 'UTF-8') ?>?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" />
  <?php endif; ?>

  <?php foreach (($pageCssExtras ?? []) as $pageCssExtra) : ?>
    <?php
      $pageCssExtra = trim((string) $pageCssExtra);

      if ($pageCssExtra === '') {
        continue;
      }

      $pageCssExtraUrl = eds_resolve_css_url($pageCssExtra, $cssUrlBase);

      if ($pageCssExtraUrl === '') {
        continue;
      }
    ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($pageCssExtraUrl, ENT_QUOTES, 'UTF-8') ?>?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" />
  <?php endforeach; ?>

  <script src="<?= BASE_URL_NORM ?>/assets/js/header.js?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" defer></script>
  <script src="<?= BASE_URL_NORM ?>/assets/js/global.js?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" defer></script>
  <script src="<?= BASE_URL_NORM ?>/assets/js/cookies.js?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" defer></script>
  <script src="<?= BASE_URL_NORM ?>/assets/js/eds-conversion-tracking.js?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" defer></script>
  <?php if (!empty($useEdsInfoOverlays) || $pageSlug === 'home') : ?>
    <script src="<?= BASE_URL_NORM ?>/assets/js/eds-commercial-overlays.js?v=<?= htmlspecialchars($assetVer, ENT_QUOTES, 'UTF-8') ?>" defer></script>
  <?php endif; ?>

  <script type="application/ld+json">
<?= json_encode($edsOrganizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
  </script>
  <script type="application/ld+json">
<?= json_encode($edsWebsiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
  </script>
  <?php if (!empty($breadcrumbs) && is_array($breadcrumbs) && count($segments) > 0) : ?>
    <script type="application/ld+json">
<?= json_encode($breadcrumbs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
    </script>
  <?php endif; ?>

  <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q1KDBYP4CG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-Q1KDBYP4CG');
  </script>
</head>
<body class="<?= htmlspecialchars($bodyClass ?? '', ENT_QUOTES, 'UTF-8') ?>">
