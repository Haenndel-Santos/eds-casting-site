<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

/**
 * Product examples are not project result cases. They should only be published
 * after EDS confirms the technical values, image paths and commercial
 * permission. Do not include old price tables.
 *
 * The user will manually add images later and update the image path after
 * approval. Keep image = null for drafts.
 */

return [
    [
        'id' => 'lashing-eye',
        'title' => 'Lashing Eye - load securing component for heavy truck applications',
        'category' => 'Load securing component',
        'summary' => 'A lightweight bolted securing component for heavy-load applications, designed for radial and axial load support depending on configuration and use conditions.',
        'key_characteristics' => [
            'Easy bolt connection',
            'Can secure a load of 15 tons radially and 6.7 tons axially',
            'Light weight of 3.8 kg',
            'M33 bolt connection',
            'Diameter 40 mm shackle connection',
        ],
        'do_not_publish' => [
            'Old price table',
        ],
        'image' => null,
        'image_alt' => 'Lashing Eye load securing component',
        'approval_status' => 'draft',
        'can_publish' => false,
        'public_note' => 'To be reviewed before publication.',
    ],
    [
        'id' => 'trailer-outrigger',
        'title' => 'Trailer Outrigger - extending trailer loading width',
        'category' => 'Trailer support component',
        'summary' => 'A compact trailer support solution designed to extend trailer loading width, combining forged and cast elements in a customizable component configuration.',
        'key_characteristics' => [
            'Easy to change on/off positions',
            'Working load of 3 ton',
            'Low own weight of 4.3 kg including outrigger and mounts',
            'Combination of steel forging for the outrigger and casting for the mounts',
            'Different sizes available and customizable if required',
        ],
        'do_not_publish' => [
            'Old price table',
        ],
        'image' => null,
        'image_alt' => 'Trailer Outrigger for extending trailer loading width',
        'approval_status' => 'draft',
        'can_publish' => false,
        'public_note' => 'To be reviewed before publication.',
    ],
    [
        'id' => 'crane-foot-support',
        'title' => 'Crane Foot-Support - adjustable support component',
        'category' => 'Support component',
        'summary' => 'An adjustable support component with angular movement capability, designed around a compact foot-support arrangement.',
        'key_characteristics' => [
            'Movable in an angle up to 55°',
            'Light weight of 3.0 kg',
            'M5 grease nipple',
            '45 mm ballhead',
        ],
        'important_note' => 'The source material contains an incomplete load-capacity line: "Can secure a load of". Do not publish a load capacity for this product until EDS confirms the missing value.',
        'do_not_publish' => [
            'Incomplete load capacity',
        ],
        'image' => null,
        'image_alt' => 'Crane Foot-Support adjustable support component',
        'approval_status' => 'draft',
        'can_publish' => false,
        'public_note' => 'To be reviewed before publication.',
    ],
    [
        'id' => 'mudguard-bracket-connector',
        'title' => 'Mudguard Bracket-Connector - detachable tube-to-chassis connector',
        'category' => 'Connector component',
        'summary' => 'A standardized connector concept for connecting tubes to a chassis while preserving the possibility of easy disassembly.',
        'key_characteristics' => [
            'Connects tubes to chassis while preserving easy disassembly',
            'Difficult machining operations replaced by two nuts',
            'Standardized solution for round or square tubes',
        ],
        'image' => null,
        'image_alt' => 'Mudguard Bracket-Connector for tube-to-chassis assembly',
        'approval_status' => 'draft',
        'can_publish' => false,
        'public_note' => 'To be reviewed before publication.',
    ],
    [
        'id' => 'rod-plate-connector',
        'title' => 'Rod Plate-Connector - standardized plate and rod connection',
        'category' => 'Connector component',
        'summary' => 'A standardized solution for assembling and connecting a plate and rod by integrating multiple parts into a single component.',
        'key_characteristics' => [
            'Easier way to assemble and connect a plate and rod',
            'Integrates multiple parts into a single component',
            'Designed to reduce cost, weight and assembly time',
            'Connects plates with rods between 22 and 26 mm',
        ],
        'optional_result_data_from_project_version' => [
            '66% weight reduction',
            'From 721 gram to 327 gram',
            '65% cost reduction',
            '100% fit into requirements',
        ],
        'publication_note' => 'Treat the percentage result data as project-result data. Do not show those values publicly unless EDS confirms they are still valid and approved for publication.',
        'image' => null,
        'image_alt' => 'Rod Plate-Connector standardized component',
        'approval_status' => 'draft',
        'can_publish' => false,
        'public_note' => 'To be reviewed before publication.',
    ],
    [
        'id' => 'tube-t-connector',
        'title' => 'Tube T-connector - standardized connection for round or square tubes',
        'category' => 'Connector component',
        'summary' => 'A standardized component concept for connecting two perpendicular tubes without complex machining and while preserving easy assembly and disassembly.',
        'key_characteristics' => [
            'Designed for connecting perpendicular tubes',
            'Works with round or square tube concepts',
            'Difficult machining operations replaced by two nuts',
            'Easy-to-use component for product assembly',
        ],
        'optional_result_data_from_project_version' => [
            '69% weight reduction',
            'From 268 gram in steel to 83 gram in stainless steel',
            '31% cost reduction',
            '100% fit into requirements',
        ],
        'publication_note' => 'Treat the percentage result data as project-result data. Do not show those values publicly unless EDS confirms they are still valid and approved for publication.',
        'image' => null,
        'image_alt' => 'Tube T-connector standardized component',
        'approval_status' => 'draft',
        'can_publish' => false,
        'public_note' => 'To be reviewed before publication.',
    ],
];
