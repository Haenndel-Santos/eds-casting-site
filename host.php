<?php
header('Content-Type: text/plain; charset=utf-8');
echo "HTTP_HOST=" . ($_SERVER['HTTP_HOST'] ?? '') . PHP_EOL;
echo "HTTPS=" . ($_SERVER['HTTPS'] ?? '') . PHP_EOL;
echo "REQUEST_URI=" . ($_SERVER['REQUEST_URI'] ?? '') . PHP_EOL;