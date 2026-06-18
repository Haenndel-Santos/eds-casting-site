<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

/**
 * Careers and vacancy data for controlled editing.
 *
 * Keep closed or draft roles hidden by setting status to closed/draft or
 * is_active to false. Do not edit mail handlers from this file.
 */

return [
    [
        'id' => 'technical-account-specialist-inside-sales',
        'title' => 'Technical Account Specialist - Inside Sales',
        'location' => 'Amsterdam, Netherlands',
        'employment_type' => 'Technical commercial role / Inside sales',
        'short_description' => 'Support the link between customers, engineering, suppliers and production follow-up by translating customer requests into clear technical and commercial actions.',
        'responsibilities' => [
            'Customer relationship support',
            'Technical quotation follow-up',
            'Order coordination',
            'Supplier and purchasing coordination',
            'Sales collaboration',
            'Customer visits and fairs when relevant',
        ],
        'requirements' => [
            'Minimum 2 years of experience in a technical-commercial role, inside sales, sales support or technical customer support.',
            'Affinity with engineering, metalworking, industrial products or production processes.',
            'HBO working and thinking level, or equivalent practical experience.',
            'Good command of Dutch and English, both spoken and written.',
        ],
        'status' => 'open',
        'display_order' => 10,
        'is_active' => true,
        'cta_label' => 'Apply for this Position',
        'cta_url' => '#apply',
    ],
];
