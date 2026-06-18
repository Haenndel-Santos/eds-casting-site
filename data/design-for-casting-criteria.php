<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

/**
 * Internal criteria for future copy, project review and RFQ qualification.
 */

return [
    'parting_line' => [
        'title' => 'Parting line strategy',
        'summary' => 'The parting line affects mould complexity, draft, machining needs, core requirements and total manufacturing cost.',
    ],
    'draft' => [
        'title' => 'Draft and mould release',
        'summary' => 'Draft helps the pattern release from the mould and should be considered early in casting-oriented design.',
    ],
    'wall_thickness' => [
        'title' => 'Wall thickness and transitions',
        'summary' => 'Sharp changes in wall thickness can increase casting risk. More consistent transitions can support manufacturability and soundness.',
    ],
    'cores_and_core_prints' => [
        'title' => 'Cores and core prints',
        'summary' => 'Cores create internal cavities or complex shapes, but they add tooling, positioning and quality considerations.',
    ],
    'machining_allowance' => [
        'title' => 'Machining allowance',
        'summary' => 'Machining allowance must be considered where tighter tolerances, contact surfaces or post-casting operations are required.',
    ],
    'gating_and_risers' => [
        'title' => 'Gating and riser considerations',
        'summary' => 'Gating and risers influence filling, solidification, material yield and casting quality. These details are usually coordinated with the foundry or manufacturing partner.',
    ],
    'material_and_process_fit' => [
        'title' => 'Material and process fit',
        'summary' => 'Material, geometry, quantity, tolerance, surface requirement and tooling cost should be reviewed together before selecting a production route.',
    ],
];
