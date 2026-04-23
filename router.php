<?php
// /public_html/router.php

$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// serve assets/files directly
$fullPath = __DIR__ . $uriPath;
if ($uriPath !== '/' && is_file($fullPath)) {
  return false;
}

// forward to app.php
require __DIR__ . '/app.php';
