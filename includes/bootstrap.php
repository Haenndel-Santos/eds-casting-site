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

// Normalized BASE_URL for safe concatenation (no trailing slash, never '/')
if (!defined('BASE_URL_NORM')) {
  $norm = rtrim((string) BASE_URL, '/');
  if ($norm === '/') $norm = '';
  define('BASE_URL_NORM', $norm);
}

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// Log path (make sure /public_html/logs/ exists)
$logPath = EDS_ROOT . '/logs/php-errors.log';
ini_set('error_log', $logPath);
