<?php
/**
 * /public_html/includes/bootstrap.php
 *
 * Purpose:
 * - Provide stable absolute paths for includes regardless of routing
 * - Centralize BASE_URL normalization
 * - Configure PHP error logging
 */

// Absolute filesystem root of public_html
if (!defined('EDS_ROOT')) {
  define('EDS_ROOT', dirname(__DIR__)); // .../public_html
}

// Public base URL (subfolder install). Prefer '' at domain root.
if (!defined('BASE_URL')) {
  define('BASE_URL', '');
}

// Public canonical origin. Keep fixed so local/dev hosts never leak into SEO tags.
if (!defined('SITE_URL')) {
  define('SITE_URL', 'https://www.edscasting.com');
}

// Normalized BASE_URL for safe concatenation (no trailing slash, never '/')
if (!defined('BASE_URL_NORM')) {
  $norm = rtrim((string) BASE_URL, '/');
  if ($norm === '/') $norm = '';
  define('BASE_URL_NORM', $norm);
}

/*
 * Local-only preview switch.
 * Enables draft/project preview sections while developing on localhost,
 * without changing publication flags in /data or exposing drafts on production.
 */
if (!defined('EDS_LOCAL_PREVIEW')) {
  $previewEnv = strtolower((string) getenv('EDS_LOCAL_PREVIEW'));
  $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
  $host = preg_replace('/:\d+$/', '', $host);
  $isLocalHost = in_array($host, ['localhost', '127.0.0.1', '::1'], true);

  define('EDS_LOCAL_PREVIEW', $isLocalHost || in_array($previewEnv, ['1', 'true', 'yes', 'on'], true));
}

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// Log path (make sure /public_html/logs/ exists)
$logPath = EDS_ROOT . '/logs/php-errors.log';
ini_set('error_log', $logPath);
