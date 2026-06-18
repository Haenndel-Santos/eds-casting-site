<?php
// /public_html/router.php

$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Prevent direct access to internal project folders
if (preg_match('#^/(includes|config|data|vendor|logs|storage)(/|$)#i', $uriPath)) {
  http_response_code(404);
  echo '404 Not Found';
  exit;
}

// Redirect old /pages-php/page.php URLs
if (
  preg_match('#^/pages-php/([^/]+)\.php$#i', $uriPath, $match)
  && in_array($requestMethod, ['GET', 'HEAD'], true)
) {
  $page = strtolower($match[1]);

  // Use 302 for local development to avoid browser caching problems.
  // In production, these can be changed back to 301.
  $redirectCode = 302;

  if (in_array($page, ['add-value', 'logistics'], true)) {
    header('Location: /eds-differentials', true, $redirectCode);
    exit;
  }

  if (in_array($page, ['terms-conditions', 'terms-and-conditions'], true)) {
    header('Location: /terms', true, $redirectCode);
    exit;
  }

  header('Location: /' . $match[1], true, $redirectCode);
  exit;
}

// Serve real files directly: CSS, JS, images, PDFs, etc.
$fullPath = __DIR__ . $uriPath;

if ($uriPath !== '/' && is_file($fullPath)) {
  return false;
}

// Forward all clean URLs to the main application
require __DIR__ . '/app.php';
