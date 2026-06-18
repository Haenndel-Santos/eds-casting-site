<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

/**
 * Internal support data for classifying EDS project examples.
 *
 * These outcome categories are not rendered publicly unless an approved page
 * section explicitly includes them.
 */

return [
    [
        'id' => 'welded-to-cast-redesign',
        'title' => 'Welded-to-cast redesign',
        'summary' => 'Projects where an existing welded or assembled construction was redesigned into a cast component to reduce welding, deformation, machining or assembly complexity.',
    ],
    [
        'id' => 'weight-reduction',
        'title' => 'Weight reduction',
        'summary' => 'Projects where geometry, material choice or manufacturing route helped reduce component weight while keeping technical requirements in focus.',
    ],
    [
        'id' => 'cost-reduction',
        'title' => 'Cost reduction',
        'summary' => 'Projects where redesign, process selection, machining reduction, assembly simplification or sourcing route improvements helped reduce total component cost.',
    ],
    [
        'id' => 'machining-reduction',
        'title' => 'Machining reduction',
        'summary' => 'Projects where the component design or casting route helped reduce secondary machining operations or improve near-net-shape manufacturability.',
    ],
    [
        'id' => 'assembly-simplification',
        'title' => 'Assembly simplification',
        'summary' => 'Projects where multiple parts, welded elements or bolted constructions were simplified into a more efficient component or assembly concept.',
    ],
    [
        'id' => 'fatigue-and-stress-improvement',
        'title' => 'Fatigue and stress improvement',
        'summary' => 'Projects where the redesign focused on fatigue resistance, stress distribution, vibration loading or structural performance.',
    ],
    [
        'id' => 'material-conversion',
        'title' => 'Material conversion',
        'summary' => 'Projects where the manufacturing route involved a material change, such as steel to ductile iron, steel to ADI, cast iron to forging, or another technically justified material alternative.',
    ],
    [
        'id' => 'supply-route-control',
        'title' => 'Controlled sourcing route',
        'summary' => 'Projects where EDS added value by clarifying the production route, supplier coordination, documentation needs and long-term supply approach.',
    ],
];
