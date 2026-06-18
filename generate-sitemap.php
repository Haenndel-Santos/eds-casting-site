<?php
declare(strict_types=1);

/**
 * EDS Sitemap Generator (Smart + Clean URLs)
 * Location: public_html/generate-sitemap.php
 *
 * Run (from public_html):
 *   php generate-sitemap.php --base=https://www.edscasting.com --out=./sitemap.xml
 */

function arg(string $name, ?string $default = null): ?string {
    global $argv;
    foreach ($argv as $a) {
        if (strpos($a, "--{$name}=") === 0) {
            return substr($a, strlen($name) + 3);
        }
    }
    return $default;
}

$base = rtrim((string) arg('base', 'https://www.edscasting.com'), '/');
$out  = (string) arg('out', './sitemap.xml');
$pagesDir = 'pages-php';

if (!is_dir($pagesDir)) {
    fwrite(STDERR, "Pages directory not found: {$pagesDir}\n");
    exit(1);
}

// Patterns that should never be indexed
$excludePatterns = [
    '/-mail\.php$/i',            // careers-mail.php, vacancies-mail.php
    '/(^|\/)test\.php$/i',       // test.php
    '/(^|\/)new-leads\.php$/i',  // internal
    '/(^|\/)debug\.log$/i',
];

// Exclude whole URL prefixes (public paths)
$excludeUrlPrefixes = [
    // '/project/',
];

// Exclude specific public paths
$excludeExactPaths = [
    '/add-value',
    '/logistics',
    '/privacy',
    '/terms',
    '/disclaimer',
    '/terms-conditions',
    '/thank-you',
];

// Pages that are declared as noindex in includes/seo.php must not be listed here.
// Keep this list aligned with SEO robots rules for future noindex public routes.
$noindexExactPaths = [
    '/add-value',
    '/logistics',
    '/privacy',
    '/terms',
    '/disclaimer',
    '/terms-conditions',
    '/thank-you',
];

// Strategic pages (higher priority)
$priorityTopLevel = [
    '/about-us',
    '/eds-differentials',
    '/forging',
    '/workflow',
    '/industries-partners',
    '/quality',
    '/projects',
    '/contact',
];

function isoDateFromMtime(int $mtime): string { return gmdate('Y-m-d', $mtime); }

function startsWithAny(string $path, array $prefixes): bool {
    foreach ($prefixes as $p) {
        if ($p !== '' && strpos($path, $p) === 0) return true;
    }
    return false;
}

function inferPriority(string $path, array $priorityTopLevel): string {
    if ($path === '/') return '1.0';
    if (in_array($path, $priorityTopLevel, true)) return '0.9';
    if (strpos($path, '/project/') === 0) return '0.5';
    return '0.7';
}

function inferChangefreq(string $path): string {
    if ($path === '/') return 'weekly';
    if ($path === '/contact') return 'monthly';
    if (strpos($path, '/project/') === 0) return 'yearly';
    if (in_array($path, ['/privacy', '/terms', '/disclaimer'], true)) return 'yearly';
    return 'monthly';
}

function isNoindexPath(string $path, array $noindexExactPaths): bool {
    return in_array($path, $noindexExactPaths, true);
}

function warnUnsupportedProjectCaseUrls(): void {
    $caseFile = 'data/project-cases.php';

    if (!is_file($caseFile)) {
        return;
    }

    $cases = require $caseFile;
    if (!is_array($cases)) {
        return;
    }

    foreach ($cases as $case) {
        if (!is_array($case)) {
            continue;
        }

        if (($case['approval_status'] ?? '') !== 'public_approved') {
            continue;
        }

        if (($case['can_publish'] ?? false) !== true) {
            continue;
        }

        $publicUrl = trim((string) ($case['public_url'] ?? ''));
        if ($publicUrl === '') {
            continue;
        }

        $publicUrl = '/' . ltrim($publicUrl, '/');
        $publicUrl = preg_replace('#/+#', '/', $publicUrl);

        if (strpos($publicUrl, '/projects/') !== 0) {
            continue;
        }

        $caseId = (string) ($case['id'] ?? 'unknown-case');
        fwrite(
            STDERR,
            "Warning: skipped project case public_url {$publicUrl} for {$caseId}; nested project URLs are not routable yet. Use /projects#{$caseId} or create a real route before adding it to the sitemap.\n"
        );
    }
}

$entries = [];

// Home lastmod from index.php if present
$homeMtime = is_file('index.php') ? (int) filemtime('index.php') : time();
$entries['/'] = [ 'lastmod' => isoDateFromMtime($homeMtime) ];

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($pagesDir, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($iterator as $file) {
    /** @var SplFileInfo $file */
    if (!$file->isFile()) continue;

    $fullPath = $file->getPathname();
    $filename = $file->getFilename();

    if (!preg_match('/\.php$/i', $filename)) continue;

    // Build REL path inside pages-php reliably (no OS separator issues)
    $fullNorm = str_replace('\\', '/', $fullPath);
    $prefix   = rtrim(str_replace('\\', '/', $pagesDir), '/') . '/';

    // Ensure we remove "pages-php/" from the beginning
    if (strpos($fullNorm, $prefix) === 0) {
        $rel = substr($fullNorm, strlen($prefix));
    } else {
        // Fallback: try to find '/pages-php/' anywhere
        $pos = strpos($fullNorm, '/' . trim($pagesDir, '/') . '/');
        if ($pos !== false) {
            $rel = substr($fullNorm, $pos + strlen('/' . trim($pagesDir, '/') . '/'));
        } else {
            $rel = $fullNorm;
        }
    }

    // Exclude patterns
    $skip = false;
    foreach ($excludePatterns as $pattern) {
        if (preg_match($pattern, $rel)) { $skip = true; break; }
    }
    if ($skip) continue;

    // Clean public URL: remove .php and keep subfolders
    $urlPath = '/' . preg_replace('/\.php$/i', '', $rel);
    $urlPath = preg_replace('#/+#', '/', $urlPath);

    // Apply exclusions
    if (startsWithAny($urlPath, $excludeUrlPrefixes)) continue;
    if (in_array($urlPath, $excludeExactPaths, true)) continue;
    if (isNoindexPath($urlPath, $noindexExactPaths)) continue;

    $mtime = @filemtime($fullPath);
    if ($mtime === false) $mtime = time();

    // Keep latest lastmod per URL
    if (!isset($entries[$urlPath]) || $mtime > strtotime($entries[$urlPath]['lastmod'] . ' 00:00:00 UTC')) {
        $entries[$urlPath] = [ 'lastmod' => isoDateFromMtime((int) $mtime) ];
    }
}

warnUnsupportedProjectCaseUrls();

$paths = array_keys($entries);
sort($paths);

$xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

foreach ($paths as $p) {
    $lastmod = $entries[$p]['lastmod'] ?? gmdate('Y-m-d');
    $priority = inferPriority($p, $priorityTopLevel);
    $changefreq = inferChangefreq($p);

    $xml .= "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($base . $p, ENT_XML1) . "</loc>\n";
    $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
    $xml .= "    <changefreq>{$changefreq}</changefreq>\n";
    $xml .= "    <priority>{$priority}</priority>\n";
    $xml .= "  </url>\n";
}

$xml .= "</urlset>\n";

if (file_put_contents($out, $xml) === false) {
    fwrite(STDERR, "Failed to write sitemap file.\n");
    exit(1);
}

echo "Sitemap generated successfully: {$out}\n";
echo "Total URLs: " . count($paths) . "\n";
