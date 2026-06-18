<?php
require_once __DIR__ . '/../includes/cms.php';

header('X-Robots-Tag: noindex, nofollow', true);
header('X-Frame-Options: SAMEORIGIN', true);
header('X-Content-Type-Options: nosniff', true);
header('Referrer-Policy: same-origin', true);

eds_cms_bootstrap_storage();
eds_cms_start_session();
