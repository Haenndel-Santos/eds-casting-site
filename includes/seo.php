<?php
/**
 * /public_html/includes/seo.php
 * Central SEO map for per-page <head> metadata.
 *
 * Hybrid final version for EDS Website
 * - Keeps the project’s current PHP-array architecture
 * - Adds cleaner helpers and stronger defaults
 * - Keeps path-first matching, then slug fallback, then pattern fallback
 * - Keeps legal pages as noindex,follow
 * - Exposes canonical + optional breadcrumb schema data for future use
 * - Avoids unnecessary APCu/JSON complexity for the current project stage
 */

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/cms.php';

// -------------------------------------------------------------------------
// Polyfills (for PHP < 8)
// -------------------------------------------------------------------------
if (!function_exists('str_starts_with')) {
  function str_starts_with(string $haystack, string $needle): bool {
    if ($needle === '') return true;
    return substr($haystack, 0, strlen($needle)) === $needle;
  }
}

if (!function_exists('str_ends_with')) {
  function str_ends_with(string $haystack, string $needle): bool {
    if ($needle === '') return true;
    return substr($haystack, -strlen($needle)) === $needle;
  }
}

// -------------------------------------------------------------------------
// Helpers
// -------------------------------------------------------------------------
if (!function_exists('eds_seo_path_no_query')) {
  function eds_seo_path_no_query(): string {
    static $cachedPath = null;

    if ($cachedPath !== null) {
      return $cachedPath;
    }

    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $path = parse_url($uri, PHP_URL_PATH) ?: '/';
    $path = rtrim($path, '/');
    $cachedPath = $path === '' ? '/' : $path;

    return $cachedPath;
  }
}

if (!function_exists('eds_seo_safe_segment')) {
  function eds_seo_safe_segment(string $seg): string {
    $seg = strtolower(trim($seg));
    $seg = preg_replace('/[^a-z0-9-]/', '', $seg);
    return $seg ?: '';
  }
}

if (!function_exists('eds_seo_title_case')) {
  function eds_seo_title_case(string $slug): string {
    static $cache = [];

    if (isset($cache[$slug])) {
      return $cache[$slug];
    }

    $slug = str_replace('-', ' ', $slug);
    $slug = preg_replace('/\s+/', ' ', trim($slug));
    $cache[$slug] = $slug === '' ? '' : ucwords($slug);

    return $cache[$slug];
  }
}

if (!function_exists('eds_seo_detect_site_url')) {
  function eds_seo_detect_site_url(): string {
    if (defined('SITE_URL')) {
      return SITE_URL;
    }

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
      || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);

    $scheme = $isHttps ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $base = defined('BASE_URL_NORM') ? BASE_URL_NORM : '';

    return $scheme . '://' . $host . $base;
  }
}

if (!function_exists('eds_seo_build_canonical')) {
  function eds_seo_build_canonical(string $path): string {
    if ($path !== '/' && str_ends_with($path, '/')) {
      $path = rtrim($path, '/');
    }
    return eds_seo_detect_site_url() . $path;
  }
}

if (!function_exists('eds_seo_build_breadcrumbs')) {
  function eds_seo_build_breadcrumbs(array $segments): array {
    $items = [[
      '@type' => 'ListItem',
      'position' => 1,
      'name' => 'Home',
      'item' => eds_seo_build_canonical('/'),
    ]];

    $currentPath = '';
    foreach ($segments as $index => $segment) {
      if ($segment === '') continue;

      $currentPath .= '/' . $segment;
      $items[] = [
        '@type' => 'ListItem',
        'position' => $index + 2,
        'name' => eds_seo_title_case($segment),
        'item' => eds_seo_build_canonical($currentPath),
      ];
    }

    return [
      '@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => $items,
    ];
  }
}

// -------------------------------------------------------------------------
// Detect route
// -------------------------------------------------------------------------
$__seoPath = eds_seo_path_no_query();

if (defined('BASE_URL_NORM') && BASE_URL_NORM !== '' && str_starts_with($__seoPath, BASE_URL_NORM)) {
  $__seoPath = substr($__seoPath, strlen(BASE_URL_NORM));
  $__seoPath = rtrim($__seoPath, '/');
  if ($__seoPath === '') $__seoPath = '/';
}

$__segmentsRaw = array_values(array_filter(explode('/', trim($__seoPath, '/'))));
$__segments = array_map('eds_seo_safe_segment', $__segmentsRaw);

$__slug = 'home';
if (count($__segments) >= 1) {
  $__slug = $__segments[count($__segments) - 1] ?: 'home';
}

$__aliases = [
  'terms-conditions'   => 'terms',
  'terms-and-conditions' => 'terms',
  'industries-partners' => 'industries-partners',
];

if (isset($__aliases[$__slug])) {
  $__slug = $__aliases[$__slug];
}

// -------------------------------------------------------------------------
// SEO map
// -------------------------------------------------------------------------
$__brand = 'EDS Casting & Forging';
$__suffix = ' | ' . $__brand;
$__ogDefault = '/assets/img/hero-img/eng-hero.webp';

$__seoDefault = [
  'title' => 'Casting & Forging Solutions | Engineering & Global Supply' . $__suffix,
  'desc'  => 'Engineering-driven casting and forging solutions for industrial components, supported by global sourcing, quality control, and reliable supply chain coordination.',
  'og'    => $__ogDefault,
];

$__seoByPath = [
  '/' => [
    'title' => 'Casting & Forging Sourcing | Engineering-Driven Supply Support | EDS',
    'desc'  => 'EDS supports industrial companies with engineering-driven sourcing, supplier coordination and quality follow-up for cast and forged metal components.',
    'og'    => $__ogDefault,
  ],

  '/about-us' => [
    'title' => 'About EDS | Casting & Forging Partner' . $__suffix,
    'desc'  => 'EDS supports European industrial companies with engineering-led sourcing, casting, forging, machining, quality documentation and supply coordination.',
    'og'    => '/assets/img/hero/about-us-hero1-optimized.webp',
  ],
  '/projects' => [
    'title' => 'Project Experience & Sourcing Focus Areas | EDS Casting & Forging',
    'desc'  => 'Explore the types of casting, forging, second sourcing and supplier coordination projects where EDS supports industrial customers.',
    'og'    => '/assets/img/hero/projects-optimized.webp',
  ],
  '/workflow' => [
    'title' => 'From Drawing Review to Reliable Supply | EDS Workflow',
    'desc'  => 'See how EDS supports industrial sourcing projects from technical drawing review and supplier coordination to quality documentation and reliable delivery.',
    'og'    => '/assets/img/hero/workflow-optimized.webp',
  ],
  '/quality' => [
    'title' => 'Quality Control & Supplier Risk Reduction | EDS Casting & Forging',
    'desc'  => 'EDS supports supplier risk reduction through drawing review, quality documentation follow-up, inspection coordination and clear supplier communication.',
    'og'    => '/assets/img/hero/quality-optimized.webp',
  ],
  '/industries-partners' => [
    'title' => 'Industries & Manufacturing Partners | EDS Casting & Forging',
    'desc'  => 'EDS supports industrial OEMs and suppliers in railway, machinery, energy, automotive and heavy industry with engineering-driven sourcing and supplier coordination.',
    'og'    => '/assets/img/hero/industries-optimized.webp',
  ],
  '/contact' => [
    'title' => 'Contact EDS | Discuss a Casting, Forging or Sourcing Challenge',
    'desc'  => 'Contact EDS to discuss RFQs, second sourcing, technical drawing review, supplier quality issues or industrial component sourcing projects.',
    'og'    => '/assets/img/hero/contact-optimized.webp',
  ],
  '/thank-you' => [
    'title' => 'Thank you for contacting EDS' . $__suffix,
    'desc'  => 'Confirmation that your EDS Casting & Forging inquiry has been received.',
    'og'    => $__ogDefault,
    'robots' => 'noindex,follow',
  ],
  '/eds-differentials' => [
    'title' => 'EDS Differentials | Engineering-Led Supply' . $__suffix,
    'desc'  => 'See how EDS reduces casting and forging sourcing risk with engineering review, supplier coordination, quality documentation and industrial supply support.',
    'og'    => '/assets/img/hero/dif-hero-optimized.webp',
  ],
  '/faq' => [
    'title' => 'Frequently Asked Questions' . $__suffix,
    'desc'  => 'Find answers about EDS processes, materials, quality control, lead times, machining, logistics, and project execution.',
    'og'    => $__ogDefault,
  ],
  '/our-team' => [
    'title' => 'Our Team' . $__suffix,
    'desc'  => 'Meet the people behind EDS and discover the engineering and operational expertise supporting each project we deliver.',
    'og'    => '/assets/img/hero/our-team-optimized.webp',
  ],
  '/careers' => [
    'title' => 'Careers at EDS' . $__suffix,
    'desc'  => 'Explore career opportunities, company culture, and growth possibilities at EDS Casting & Forging.',
    'og'    => '/assets/img/hero/careers-optimized.webp',
  ],
  '/vacancies' => [
    'title' => 'Open Vacancies' . $__suffix,
    'desc'  => 'Discover open positions at EDS and find a role that matches your profile, experience, and career goals.',
    'og'    => '/assets/img/hero/careers-optimized.webp',
  ],

  // Casting & process comparison
  '/casting-matrix' => [
    'title' => 'Casting Process Comparison | Casting Matrix' . $__suffix,
    'desc'  => 'Compare casting methods and identify a suitable process for your component based on tolerance, material, geometry, cost, and production volume.',
    'og'    => '/assets/img/hero/casting-matrix-optimized.webp',
  ],
  '/investment' => [
    'title' => 'Investment Casting for Precision Metal Components' . $__suffix,
    'desc'  => 'High-precision investment casting for complex geometries, tight tolerances, and engineered metal components with strong process control.',
    'og'    => '/assets/img/hero/investment-optimized.webp',
  ],
  '/shell-moulding' => [
    'title' => 'Shell Moulding Casting for Repeatable Components' . $__suffix,
    'desc'  => 'Shell moulding castings with good dimensional accuracy and surface quality, supported by engineering review and reliable production follow-up.',
    'og'    => '/assets/img/hero/shellmoulding-optimized.webp',
  ],
  '/sand-casting' => [
    'title' => 'Sand Casting for Industrial Components' . $__suffix,
    'desc'  => 'Sand casting solutions for steel and iron components with flexible geometries, robust process control, and reliable supply support.',
    'og'    => '/assets/img/hero/sandcast-optimized.webp',
  ],
  '/gravity-die' => [
    'title' => 'Gravity Die Casting for Industrial Components' . $__suffix,
    'desc'  => 'Gravity die casting solutions with consistent dimensions, repeatability, and reliable tooling control for aluminium and non-ferrous components.',
    'og'    => '/assets/img/hero/gravitydie1-optimized.webp',
  ],
  '/lost-foam' => [
    'title' => 'Lost Foam Casting for Complex Geometries' . $__suffix,
    'desc'  => 'Lost foam casting for intricate metal components with fewer parting lines, reduced machining, and engineering support from design to delivery.',
    'og'    => '/assets/img/hero/lostfoameds-optimized.webp',
  ],
  '/high-pressure-die' => [
    'title' => 'High-Pressure Die Casting for Serial Production' . $__suffix,
    'desc'  => 'High-pressure die casting for high-volume metal components with repeatable quality, fast production cycles, and controlled supplier execution.',
    'og'    => '/assets/img/hero/highpressure-optimized.webp',
  ],
  '/sintering' => [
    'title' => 'Sintering for Precision Powder Metal Components' . $__suffix,
    'desc'  => 'Sintered metal components for repeatable performance, dimensional consistency, and efficient serial production.',
    'og'    => '/assets/img/hero/sintering-optimized.webp',
  ],
  '/sand-print3d' => [
    'title' => '3D Sand Printing for Advanced Casting Development' . $__suffix,
    'desc'  => '3D sand printing for complex moulds and tooling-free development, reducing lead times and increasing design freedom in casting projects.',
    'og'    => '/assets/img/hero/3dsand-optimized.webp',
  ],
  '/printed-cores-3d' => [
    'title' => '3D Printed Cores for Complex Internal Geometries' . $__suffix,
    'desc'  => '3D printed cores that enable advanced internal passages, faster prototyping, and efficient transfer to casting production.',
    'og'    => '/assets/img/hero/3dcores-optimized.webp',
  ],

  // Forging
  '/forging' => [
    'title' => 'Forging Solutions | Closed Die & Open Die' . $__suffix,
    'desc'  => 'Compare closed die, open die and rolled ring forging for high-strength industrial components with engineering-led sourcing and quality support.',
    'og'    => '/assets/img/hero/forging-optimized.webp',
  ],
  '/closed-die' => [
    'title' => 'Closed Die Forging for High-Strength Components' . $__suffix,
    'desc'  => 'Closed die forgings with high strength, repeatability, and tight tolerances for demanding industrial applications.',
    'og'    => '/assets/img/hero/closed-die-optimized.webp',
  ],
  '/open-die' => [
    'title' => 'Open Die Forging for Large Industrial Components' . $__suffix,
    'desc'  => 'Open die forging for large or low-volume components requiring robust mechanical properties and controlled manufacturing execution.',
    'og'    => '/assets/img/hero/open-die-optimized.webp',
  ],
  '/rolled-ring' => [
    'title' => 'Rolled Ring Forging for Seamless High-Integrity Rings' . $__suffix,
    'desc'  => 'Seamless rolled ring forgings with controlled material flow, dimensional stability, and strong performance in critical applications.',
    'og'    => '/assets/img/hero/rolledring-optimized.webp',
  ],
  '/multi-directional' => [
    'title' => 'Multi-Directional Forging for Complex Shapes' . $__suffix,
    'desc'  => 'Multi-direction forging for advanced geometries and enhanced mechanical properties, supported by optimized material flow and repeatable outcomes.',
    'og'    => '/assets/img/hero/multidir-optimized.webp',
  ],

  // Value-added services
  '/machining' => [
    'title' => 'Precision Machining for Cast and Forged Components' . $__suffix,
    'desc'  => 'CNC machining services that ensure critical tolerances, functional interfaces, and reliable part readiness for assembly and end use.',
    'og'    => '/assets/img/hero/machining-optimized.webp',
  ],
  '/surface-finishing' => [
    'title' => 'Surface Finishing for Protection and Performance' . $__suffix,
    'desc'  => 'Surface finishing solutions that improve corrosion resistance, appearance, durability, and functional performance of industrial components.',
    'og'    => '/assets/img/hero/surface-optimized.webp',
  ],
  '/assemblies' => [
    'title' => 'Assemblies for Integrated Mechanical Solutions' . $__suffix,
    'desc'  => 'Assembly solutions that reduce supplier complexity by integrating parts, subassemblies, and controlled documentation into one reliable delivery flow.',
    'og'    => '/assets/img/hero/assemb-optimized.webp',
  ],

  // Supply chain
  '/supply-chain' => [
    'title' => 'Supply Chain Management for Industrial Components' . $__suffix,
    'desc'  => 'Supply chain coordination that improves lead-time stability, sourcing visibility, communication, and delivery reliability across industrial projects.',
    'og'    => '/assets/img/hero/supply-optimized.webp',
  ],
  '/warehousing' => [
    'title' => 'Warehousing & Stock Keeping for Reliable Supply' . $__suffix,
    'desc'  => 'Warehousing and stock keeping solutions that help reduce downtime, improve replenishment control, and support predictable supply programs.',
    'og'    => '/assets/img/hero/warehousing-optimized.webp',
  ],

  // Legal (noindex)
  '/terms' => [
    'title' => 'Terms & Conditions' . $__suffix,
    'desc'  => 'General terms and conditions for EDS Casting & Forging.',
    'og'    => $__ogDefault,
    'robots' => 'noindex,follow',
  ],
  '/terms-conditions' => [
    'title' => 'Terms & Conditions' . $__suffix,
    'desc'  => 'General terms and conditions for EDS Casting & Forging.',
    'og'    => $__ogDefault,
    'robots' => 'noindex,follow',
  ],
  '/privacy' => [
    'title' => 'Privacy Policy' . $__suffix,
    'desc'  => 'Privacy policy for EDS Casting & Forging website.',
    'og'    => $__ogDefault,
    'robots' => 'noindex,follow',
  ],
  '/disclaimer' => [
    'title' => 'Disclaimer' . $__suffix,
    'desc'  => 'Disclaimer for EDS Casting & Forging website.',
    'og'    => $__ogDefault,
    'robots' => 'noindex,follow',
  ],
];

$__seoBySlug = [
  'home' => $__seoByPath['/'],
  'about-us' => $__seoByPath['/about-us'],
  'projects' => $__seoByPath['/projects'],
  'workflow' => $__seoByPath['/workflow'],
  'quality' => $__seoByPath['/quality'],
  'industries-partners' => $__seoByPath['/industries-partners'],
  'contact' => $__seoByPath['/contact'],
  'thank-you' => $__seoByPath['/thank-you'],
  'faq' => $__seoByPath['/faq'],
  'our-team' => $__seoByPath['/our-team'],
  'careers' => $__seoByPath['/careers'],
  'vacancies' => $__seoByPath['/vacancies'],
  'forging' => $__seoByPath['/forging'],
  'casting-matrix' => $__seoByPath['/casting-matrix'],
  'investment' => $__seoByPath['/investment'],
  'shell-moulding' => $__seoByPath['/shell-moulding'],
  'sand-casting' => $__seoByPath['/sand-casting'],
  'gravity-die' => $__seoByPath['/gravity-die'],
  'lost-foam' => $__seoByPath['/lost-foam'],
  'high-pressure-die' => $__seoByPath['/high-pressure-die'],
  'sintering' => $__seoByPath['/sintering'],
  'sand-print3d' => $__seoByPath['/sand-print3d'],
  'printed-cores-3d' => $__seoByPath['/printed-cores-3d'],
  'closed-die' => $__seoByPath['/closed-die'],
  'open-die' => $__seoByPath['/open-die'],
  'rolled-ring' => $__seoByPath['/rolled-ring'],
  'multi-directional' => $__seoByPath['/multi-directional'],
  'machining' => $__seoByPath['/machining'],
  'surface-finishing' => $__seoByPath['/surface-finishing'],
  'assemblies' => $__seoByPath['/assemblies'],
  'supply-chain' => $__seoByPath['/supply-chain'],
  'warehousing' => $__seoByPath['/warehousing'],
  'eds-differentials' => $__seoByPath['/eds-differentials'],
  'terms' => $__seoByPath['/terms'],
  'privacy' => $__seoByPath['/privacy'],
  'disclaimer' => $__seoByPath['/disclaimer'],
];

$__patternSeo = null;
if (count($__segments) >= 2) {
  $section = $__segments[0];
  $child = $__segments[count($__segments) - 1];

  if (in_array($section, ['projects'], true)) {
    $childTitle = eds_seo_title_case($child);
    $__patternSeo = [
      'title' => $childTitle . ' Project Case Study' . $__suffix,
      'desc'  => 'Explore this EDS project case study and see how engineering support, manufacturing coordination, and supply planning were applied in practice.',
      'og'    => $__ogDefault,
    ];
  }
}

// -------------------------------------------------------------------------
// Choose best match
// -------------------------------------------------------------------------
$__seo = $__seoByPath[$__seoPath] ?? null;
if (!$__seo) {
  $__seo = $__seoBySlug[$__slug] ?? null;
}
if (!$__seo && $__patternSeo) {
  $__seo = $__patternSeo;
}
if (!$__seo) {
  $__seo = $__seoDefault;
}

$__cmsPageSeo = eds_get_page_content($__slug, []);
eds_cms_set_current_page_content(is_array($__cmsPageSeo) ? $__cmsPageSeo : []);
if (is_array($__cmsPageSeo) && $__cmsPageSeo) {
  if (!empty($__cmsPageSeo['meta_title'])) {
    $__seo['title'] = (string) $__cmsPageSeo['meta_title'];
  } elseif (!empty($__cmsPageSeo['title'])) {
    $__seo['title'] = (string) $__cmsPageSeo['title'] . $__suffix;
  }
  if (!empty($__cmsPageSeo['meta_description'])) {
    $__seo['desc'] = (string) $__cmsPageSeo['meta_description'];
  }
  if (!empty($__cmsPageSeo['hero_image'])) {
    $__seo['og'] = (string) $__cmsPageSeo['hero_image'];
  }
}
eds_cms_start_public_page_filter(is_array($__cmsPageSeo) ? $__cmsPageSeo : []);

// -------------------------------------------------------------------------
// Derived SEO variables for current page
// -------------------------------------------------------------------------
$canonical = $canonical ?? eds_seo_build_canonical($__seoPath);
$breadcrumbs = $breadcrumbs ?? eds_seo_build_breadcrumbs($__segments);

// -------------------------------------------------------------------------
// Apply only if page has not set overrides
// -------------------------------------------------------------------------
if (is_array($__seo)) {
  if (!isset($pageTitle) || $pageTitle === '') {
    $pageTitle = $__seo['title'] ?? ($pageTitle ?? '');
  }
  if (!isset($pageDescription) || $pageDescription === '') {
    $pageDescription = $__seo['desc'] ?? ($pageDescription ?? '');
  }
  if (!isset($ogImage) || $ogImage === '') {
    $ogImage = $__seo['og'] ?? ($ogImage ?? '');
  }
  if (!isset($robots) || $robots === '') {
    if (!empty($__seo['robots'])) {
      $robots = $__seo['robots'];
    }
  }
}

// Optional debug exposure
$seoDebug = $seoDebug ?? [
  'path' => $__seoPath,
  'slug' => $__slug,
  'matched' => $__seo ? 'map/pattern/default' : 'none',
  'canonical' => $canonical,
];
