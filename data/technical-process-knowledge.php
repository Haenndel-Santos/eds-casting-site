<?php
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit;
}

/**
 * Internal technical support notes for future EDS copy and review.
 *
 * This data is not rendered publicly by default and must not expose internal
 * document names, personal names, supplier names or confidential references.
 */

return [
    'casting_process_awareness' => [
        'purpose' => 'Store concise internal notes that help website copy remain technically accurate.',
        'processes' => [
            [
                'name' => 'Sand casting',
                'short_description' => 'Sand casting uses a sand mould formed around a pattern. It is suitable for a wide range of ferrous and non-ferrous materials and can support large or complex parts depending on tooling, moulding method and production requirements.',
                'typical_design_considerations' => [
                    'parting line',
                    'draft',
                    'wall thickness',
                    'cores and core prints',
                    'machining allowance',
                    'shrinkage allowance',
                    'gating and riser strategy',
                    'surface roughness and post-processing needs',
                ],
                'sourcing_relevance' => 'EDS can help customers review whether a component geometry, material and quantity fit a sand casting route and coordinate technical discussion with selected manufacturing partners.',
                'wording_to_use' => [
                    'casting-oriented design review',
                    'patternmaking considerations',
                    'tooling and process feasibility',
                    'supplier coordination for sand casting',
                ],
                'wording_to_avoid' => [
                    'EDS produces the moulds in-house',
                    'EDS owns the foundry',
                    'fixed cost reduction for all sand casting projects',
                ],
            ],
            [
                'name' => 'Permanent mould casting / gravity die casting',
                'short_description' => 'Permanent mould or gravity die casting uses reusable tooling and gravity-fed metal flow. It can support repeatable production for suitable non-ferrous components where tooling investment and geometry fit are justified.',
                'typical_design_considerations' => [
                    'tooling feasibility',
                    'draft and mould release',
                    'wall thickness consistency',
                    'feeding and solidification',
                    'expected production volume',
                    'surface and dimensional expectations',
                ],
                'sourcing_relevance' => 'EDS can help evaluate whether repeatability, material, geometry and volume make a gravity die casting route realistic.',
                'wording_to_use' => [
                    'permanent mould feasibility review',
                    'gravity die casting route evaluation',
                    'repeatability and tooling review',
                    'supplier coordination for reusable tooling routes',
                ],
                'wording_to_avoid' => [
                    'EDS owns permanent mould tooling facilities',
                    'gravity die casting is always cheaper',
                    'guaranteed tolerance improvement',
                ],
            ],
            [
                'name' => 'High pressure die casting',
                'short_description' => 'High pressure die casting injects molten metal into a steel die under pressure. It is typically linked to higher-volume production of suitable non-ferrous components with controlled tooling and process requirements.',
                'typical_design_considerations' => [
                    'tooling cost and production volume',
                    'wall thickness and flow length',
                    'draft',
                    'ejection and parting line',
                    'porosity risk',
                    'machining and finishing needs',
                ],
                'sourcing_relevance' => 'EDS can help customers review whether the technical and commercial profile of a component fits a high pressure die casting route.',
                'wording_to_use' => [
                    'high-volume process assessment',
                    'die casting feasibility',
                    'tooling investment review',
                    'supplier coordination for die casting',
                ],
                'wording_to_avoid' => [
                    'EDS operates die casting machines',
                    'high pressure die casting fits every aluminium part',
                    'guaranteed lowest unit price',
                ],
            ],
            [
                'name' => 'Investment casting / lost wax casting',
                'short_description' => 'Investment casting uses wax patterns and ceramic shells to produce complex components with good detail and surface quality for suitable materials and quantities.',
                'typical_design_considerations' => [
                    'component complexity',
                    'wall thickness',
                    'tolerance expectations',
                    'surface finish',
                    'machining allowance',
                    'material selection',
                    'tooling and pattern approach',
                ],
                'sourcing_relevance' => 'EDS can help evaluate whether complex geometry, tolerance expectations and material requirements make investment casting a suitable route.',
                'wording_to_use' => [
                    'lost wax casting route review',
                    'near-net-shape feasibility',
                    'complex geometry evaluation',
                    'supplier coordination for investment casting',
                ],
                'wording_to_avoid' => [
                    'EDS produces wax patterns in-house',
                    'investment casting removes all machining',
                    'guaranteed precision for every geometry',
                ],
            ],
            [
                'name' => 'Forging',
                'short_description' => 'Forging shapes metal under compressive force and is often selected where strength, grain flow, fatigue behavior or load-bearing performance are important.',
                'typical_design_considerations' => [
                    'material grade',
                    'grain flow and load direction',
                    'tooling concept',
                    'draft and flash',
                    'machining allowance',
                    'heat treatment',
                    'mechanical property requirements',
                ],
                'sourcing_relevance' => 'EDS can help customers evaluate whether a forged route fits the load case, material requirement, geometry and production volume.',
                'wording_to_use' => [
                    'forging route evaluation',
                    'load-case and material review',
                    'forging supplier coordination',
                    'machining and heat-treatment follow-up',
                ],
                'wording_to_avoid' => [
                    'EDS operates a forge',
                    'forging is always stronger for every application',
                    'guaranteed lead-time improvement',
                ],
            ],
        ],
    ],
];
