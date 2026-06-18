<?php
require_once __DIR__ . '/_bootstrap.php';

eds_cms_logout();
eds_cms_redirect('/admin/login.php');
