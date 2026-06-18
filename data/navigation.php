<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

return [
    'primary' => [
        [
            'label' => 'Institutional',
            'url' => '/about-us',
            'is_active' => true,
            'display_order' => 10,
        ],
        [
            'label' => 'Differentials',
            'url' => '/eds-differentials',
            'is_active' => true,
            'display_order' => 20,
        ],
        [
            'label' => 'Projects',
            'url' => '/projects',
            'is_active' => true,
            'display_order' => 30,
        ],
        [
            'label' => 'Industries & Partners',
            'url' => '/industries-partners',
            'is_active' => true,
            'display_order' => 40,
        ],
        [
            'label' => 'Contact Us',
            'url' => '/contact',
            'is_active' => true,
            'display_order' => 50,
        ],
    ],
];
