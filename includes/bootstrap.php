<?php
/**
 * /public_html/includes/bootstrap.php
 *
 * Purpose:
 * - Provide stable absolute paths for includes regardless of routing
 * - Centralize BASE_URL normalization
 * - TEMP DEBUG: Print last fatal error as HTML comment + log to /logs/php-errors.log
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

/* ============================
   TEMP DEBUG — ENABLED
   ============================ */

ini_set('display_errors', '0');       // keep UI clean
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

// Log path (make sure /public_html/logs/ exists)
$logPath = EDS_ROOT . '/logs/php-errors.log';
ini_set('error_log', $logPath);

register_shutdown_function(function () {
  $e = error_get_last();
  if (!$e) return;

  $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
  if (!in_array($e['type'], $fatalTypes, true)) return;

  $msg  = $e['message'] ?? 'unknown error';
  $file = $e['file'] ?? 'unknown file';
  $line = (int)($e['line'] ?? 0);

  // Visible in View Source even when the page breaks
  echo "\n<!-- PHP FATAL: " . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8')
     . " | FILE: " . htmlspecialchars($file, ENT_QUOTES, 'UTF-8')
     . " | LINE: " . $line . " -->\n";
});
