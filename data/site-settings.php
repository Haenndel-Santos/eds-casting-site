<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

return [
    'site_name' => 'EDS Casting & Forging',
    'site_url' => 'https://www.edscasting.com',
    'contact_url' => '/contact',
    'quotation_url' => '/contact#request-quotation',
    'default_project_image_folder' => '/assets/img/projects/case-studies/',
    'content_owner_note' => 'Flat-file content is edited through VS Code, GitHub or DirectAdmin only. There is no public admin panel.',
];
