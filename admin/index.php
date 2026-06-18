<?php
require_once __DIR__ . '/_bootstrap.php';

eds_cms_redirect(eds_cms_current_user() ? '/admin/dashboard.php' : '/admin/login.php');
