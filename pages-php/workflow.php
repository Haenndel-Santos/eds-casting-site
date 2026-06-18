<?php
require_once __DIR__ . '/../includes/seo.php';

/* Workflow uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;
$assetVer = '2026.05.01.workflow-2';

$pageTitle = 'From Drawing Review to Reliable Supply | EDS Workflow';
$pageDescription = 'See how EDS supports industrial sourcing projects from technical drawing review and supplier coordination to quality documentation and reliable delivery.';

$workflowStages = [
  [
    'id' => 'popup-material',
    'icon' => '/assets/img/core-icons/material.webp',
    'label' => 'Material Selection',
    'short' => 'Define the right material before production begins.',
    'title' => 'Material Selection',
    'body' => [
      'Every reliable industrial component starts with a suitable material choice. EDS reviews chemical composition, mechanical properties, corrosion exposure, heat treatment needs, manufacturability and total cost before aligning the requirement with supplier capability.',
      'By combining engineering review with production experience from foundries, forging suppliers and machining partners, EDS helps customers select materials that fit both technical performance and commercial feasibility.',
    ],
    'benefits' => 'Improved mechanical performance, longer component life, better production consistency and a stronger balance between cost, strength and application requirements.',
    'link' => '/quality',
    'linkText' => 'View quality documentation',
  ],
  [
    'id' => 'popup-weight',
    'icon' => '/assets/img/core-icons/weight.webp',
    'label' => 'Weight Reduction',
    'short' => 'Reduce unnecessary mass while preserving strength and reliability.',
    'title' => 'Weight Optimization',
    'body' => [
      'Weight optimization is part of a broader engineering decision: the component must be strong enough for its load case while avoiding unnecessary material, machining time, handling weight and logistics cost.',
      'EDS supports this review by considering geometry, material grade, wall thickness, manufacturing method, machining allowance and the practical limitations of casting, forging and finishing processes.',
    ],
    'benefits' => 'Lower material use, reduced handling and transport cost, improved efficiency and better total cost control without compromising component performance.',
    'link' => '/casting-matrix',
    'linkText' => 'Compare casting routes',
  ],
  [
    'id' => 'popup-testing',
    'icon' => '/assets/img/core-icons/loadcase.webp',
    'label' => 'FEM Calculation',
    'short' => 'Validate structural behavior before production risk increases.',
    'title' => 'Load Case & FEM Analysis',
    'body' => [
      'Load case review and FEM analysis help define whether a component design is aligned with its real operating conditions. Stress distribution, deformation, fatigue risk, safety factors and potential weak zones can be evaluated before tooling or serial production decisions are made.',
      'EDS uses this engineering mindset to support better discussions between customers, suppliers and technical partners, especially when component reliability is critical.',
    ],
    'benefits' => 'Improved design confidence, reduced physical trial-and-error, better supplier communication and stronger alignment between design intent and production feasibility.',
    'link' => '/eds-differentials',
    'linkText' => 'Explore EDS differentials',
  ],
  [
    'id' => 'popup-machining',
    'icon' => '/assets/img/core-icons/machining.webp',
    'label' => 'Machining',
    'short' => 'Transform cast and forged parts into application-ready components.',
    'title' => 'Machining & Finishing',
    'body' => [
      'Machining and finishing connect the manufacturing route with the final functional requirement. EDS coordinates CNC machining, turning, milling, drilling, grinding, surface finishing and related value-added processes for cast and forged components.',
      'The objective is to ensure that critical dimensions, interfaces, surface conditions and assembly requirements are controlled before the part reaches the customer.',
    ],
    'benefits' => 'Better dimensional accuracy, reduced rework, improved fit during assembly and stronger control over final component readiness.',
    'link' => '/machining',
    'linkText' => 'Explore machining support',
  ],
  [
    'id' => 'popup-assembly',
    'icon' => '/assets/img/core-icons/assembly.webp',
    'label' => 'Assembly',
    'short' => 'Coordinate components into functional and ready-to-install units.',
    'title' => 'Assembly Lines',
    'body' => [
      'For selected projects, EDS supports mechanical assemblies and subassemblies that combine cast, forged, machined, finished and purchased components. This may include fit checks, functional checks, fasteners, bearings, seals and final packing requirements.',
      'Assembly support helps customers reduce internal handling, simplify purchasing and receive components that are closer to direct integration into the final application.',
    ],
    'benefits' => 'Reduced supplier coordination, improved assembly accuracy, fewer handovers and better readiness before shipment.',
    'link' => '/assemblies',
    'linkText' => 'Explore assemblies',
  ],
  [
    'id' => 'popup-supply-chain',
    'icon' => '/assets/img/core-icons/supplychain.webp',
    'label' => 'Supply Chain',
    'short' => 'Connect production, documentation, logistics and delivery follow-up.',
    'title' => 'Supply Chain Coordination',
    'body' => [
      'EDS approaches supply chain coordination as part of the engineering workflow. Production follow-up, supplier communication, inspection status, documentation, packing and logistics must stay connected to avoid delays and unexpected cost.',
      'Through international supplier coordination and practical follow-up, EDS helps customers maintain better visibility over the route from technical requirement to delivered component.',
    ],
    'benefits' => 'Improved lead time visibility, better traceability, stronger delivery reliability and reduced operational complexity for industrial buyers.',
    'link' => '/supply-chain',
    'linkText' => 'Explore supply chain support',
  ],
];

$workflowSchemaItems = [];

foreach ($workflowStages as $index => $stage) {
  $workflowSchemaItems[] = [
    '@type' => 'ListItem',
    'position' => $index + 1,
    'name' => $stage['label'],
    'description' => $stage['short'],
  ];
}

$workflowSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'ItemList',
  'name' => 'EDS Engineering Workflow for Industrial Component Sourcing',
  'description' => 'Workflow stages used by EDS Casting & Forging to support industrial casting, forging, machining, quality documentation and supply chain coordination projects.',
  'itemListElement' => $workflowSchemaItems,
];

$workflowServiceSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'Service',
  'name' => 'Industrial Component Sourcing and Supplier Coordination',
  'provider' => [
    '@type' => 'Organization',
    'name' => 'EDS Casting & Forging B.V.',
    'url' => 'https://www.edscasting.com',
  ],
  'serviceType' => 'Engineering-driven sourcing for cast and forged industrial components',
  'description' => 'EDS supports OEMs from technical drawing review to supplier and process selection, production coordination, quality follow-up, delivery documentation and long-term supply support.',
  'areaServed' => 'Europe',
];

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page workflow-page">

  <!-- HERO -->
  <section
    class="process-hero workflow-hero"
    aria-labelledby="workflow-hero-title"
    style="background-image: url('/assets/img/hero/workflow-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="workflow-hero-title">Engineering Workflow for Reliable Industrial Component Sourcing</h1>

      <p class="process-hero__summary">
        EDS connects material selection, engineering review, machining, FEM validation, assembly support,
        quality documentation and supply chain coordination into one structured project workflow.
      </p>

      <div class="process-hero__actions" aria-label="Workflow page actions">
        <a class="process-btn process-btn--primary" href="#stages" data-eds-track data-eds-event="internal_strategy_link_click" data-eds-label="workflow_hero_stages" data-eds-category="workflow_hero">Explore the Workflow</a>
        <a class="process-btn process-btn--secondary" href="/contact#sourcing-challenge" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="workflow_hero_discuss_project" data-eds-category="workflow_hero">Discuss Your Project</a>
      </div>
    </div>
  </section>

  <?php
    $edsBreadcrumbItems = [
      ['label' => 'Home', 'url' => '/'],
      ['label' => 'What We Do', 'url' => '/workflow'],
    ];
    include __DIR__ . '/../includes/breadcrumbs.php';
  ?>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="Workflow page navigation">
    <a href="#from-drawing-to-reliable-supply">Overview</a>
    <a href="#sourcing-support-steps">Sourcing Support</a>
    <a href="#common-sourcing-challenges">Challenges</a>
    <a href="#stages">Stages</a>
    <a href="#quality-flow">Quality Flow</a>
    <a href="#related">Related</a>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="from-drawing-to-reliable-supply" aria-labelledby="workflow-overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">EDS Workflow</p>
        <h2 id="workflow-overview-title">From drawing review to reliable supply</h2>
        <p>
          A reliable sourcing project starts before production begins. EDS reviews technical drawings, material
          requirements, tolerances, application context and documentation expectations so that sourcing decisions are
          based on more than price alone.
        </p>
        <p>
          EDS does not operate its own foundry or forging plant. Instead, we act as an engineering-driven sourcing,
          supplier coordination and industrial supply chain partner for cast and forged metal components.
        </p>
        <p>
          By coordinating with selected manufacturing partners, following up production communication and supporting
          quality documentation, EDS helps customers move from technical requirements to a controlled supply route.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="EDS workflow strengths">
        <article>
          <h3>Engineering Review</h3>
          <p>Drawings, materials, geometry, tolerances and application requirements are reviewed before supplier coordination.</p>
        </article>

        <article>
          <h3>Supplier Coordination</h3>
          <p>Production partners are selected and followed according to process capability, documentation needs and delivery expectations.</p>
        </article>

        <article>
          <h3>Delivery Control</h3>
          <p>Quality documentation, packing, logistics and communication are coordinated before components reach the customer.</p>
        </article>
      </div>
    </section>

    <section class="eds-commercial-section eds-commercial-section--soft" id="sourcing-support-steps" aria-labelledby="sourcing-support-title">
      <div class="eds-commercial-header">
        <p class="eds-commercial-eyebrow">What We Do</p>
        <h2 id="sourcing-support-title">From drawing review to reliable supply</h2>
        <p>
          A reliable sourcing project starts before production begins. EDS reviews technical drawings, material
          requirements, tolerances, application context and documentation expectations so that sourcing decisions are
          based on more than price alone.
        </p>
        <p>
          By coordinating with selected manufacturing partners, following up production communication and supporting
          quality documentation, EDS helps customers move from technical requirements to a controlled supply route.
        </p>
      </div>

      <div class="eds-steps" aria-label="EDS sourcing support steps">
        <article class="eds-step">
          <h3>Technical review</h3>
          <p>We review drawings, material requirements, tolerances, application context and documentation expectations before the sourcing route is confirmed.</p>
        </article>
        <article class="eds-step">
          <h3>Manufacturing route selection</h3>
          <p>EDS helps evaluate whether casting, forging, machining, surface treatment, assembly or logistics support is required.</p>
        </article>
        <article class="eds-step">
          <h3>Supplier coordination</h3>
          <p>EDS coordinates with selected manufacturing partners and keeps communication aligned between customer requirements and production capabilities.</p>
        </article>
        <article class="eds-step">
          <h3>Quality and documentation follow-up</h3>
          <p>Depending on project requirements, EDS can support certificates, dimensional reports, inspection records and customer-specific documents.</p>
        </article>
        <article class="eds-step">
          <h3>Delivery and supply continuity</h3>
          <p>EDS supports logistics communication and recurring supply coordination so sourcing is not treated as a one-off transaction.</p>
        </article>
        <article class="eds-step">
          <h3>Continuous reporting and improvement</h3>
          <p>Performance feedback, recurring issue tracking and coordination updates are consolidated to improve next deliveries and reduce repeat risk.</p>
        </article>
      </div>

      <p class="workflow-support-cta">
        <a class="process-btn process-btn--primary workflow-cta-btn" href="/contact#sourcing-challenge" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="workflow_what_we_do_contact" data-eds-category="workflow_what_we_do">Discuss Your Sourcing Challenge with EDS</a>
      </p>
    </section>

    <section class="eds-commercial-section" id="common-sourcing-challenges" aria-labelledby="common-challenges-title">
      <div class="eds-commercial-header">
        <p class="eds-commercial-eyebrow">Client Problems</p>
        <h2 id="common-challenges-title">When EDS adds value</h2>
        <p>
          Customers often contact EDS when a component is technically important, difficult to source or linked to supplier risk.
          These are typical situations where our engineering-driven sourcing approach can add value.
        </p>
      </div>

      <ul class="eds-challenge-list">
        <li>A current supplier is no longer reliable.</li>
        <li>A second source is needed.</li>
        <li>A casting or forging route must be validated.</li>
        <li>A drawing needs practical manufacturing input.</li>
        <li>Quality documents must be coordinated before shipment.</li>
        <li>Cost reduction is required without losing technical control.</li>
      </ul>

      <p class="workflow-challenges-cta">
        <a class="process-btn process-btn--primary workflow-cta-btn" href="/contact#sourcing-challenge" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="workflow_common_challenges_contact" data-eds-category="workflow_challenges">Discuss your sourcing workflow with EDS</a>
      </p>
    </section>

    <!-- STAGES -->
    <section class="process-section workflow-stages-section" id="stages" aria-labelledby="workflow-stages-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Workflow Stages</p>
        <h2 id="workflow-stages-title">The main stages behind EDS project coordination</h2>
        <p>
          The CoreCircle visual provides the high-level map, and the table lists each stage in sequence with its
          practical role in EDS project coordination.
        </p>
      </div>

      <div class="workflow-stages-layout" aria-label="EDS workflow stages">
        <figure class="workflow-static-visual">
          <img
            src="/assets/img/CoreCircle-II.webp"
            alt="EDS engineering, design and supply workflow overview"
            width="760"
            height="540"
            loading="lazy"
            decoding="async"
          >
        </figure>

        <table class="process-spec-table workflow-stages-table" aria-label="CoreCircle workflow stages">
          <thead>
            <tr>
              <th scope="col">Stage</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $workflowTableContent = [
                [
                  'label' => 'Material Selection',
                  'description' => 'Select suitable materials based on application requirements, production route, load conditions and documentation needs.',
                ],
                [
                  'label' => 'Weight Reduction',
                  'description' => 'Optimize geometry and material use to reduce mass while maintaining strength, function and reliability.',
                ],
                [
                  'label' => 'Load & FEM Review',
                  'description' => 'Review working loads, stress areas and FEM results to validate the design before production risks increase.',
                ],
                [
                  'label' => 'Machining',
                  'description' => 'Define machining requirements and tolerances to transform cast and forged parts into application-ready components.',
                ],
                [
                  'label' => 'Assembly',
                  'description' => 'Coordinate components, interfaces and finishing steps into functional and ready-to-install units.',
                ],
                [
                  'label' => 'Supply Chain',
                  'description' => 'Connect production, documentation, quality follow-up, logistics and delivery coordination in one controlled workflow.',
                ],
              ];
            ?>
            <?php foreach ($workflowStages as $index => $stage): ?>
              <?php
                $stageNumber = $index + 1;
                $tableLabel = $workflowTableContent[$index]['label'] ?? $stage['label'];
                $tableDescription = $workflowTableContent[$index]['description'] ?? $stage['short'];
              ?>
              <tr>
                <th scope="row">
                  <div class="workflow-stage-title">
                    <img
                      src="<?= htmlspecialchars((string) ($stage['icon'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                      alt="<?= htmlspecialchars($tableLabel, ENT_QUOTES, 'UTF-8') ?> icon"
                      width="70"
                      height="70"
                      loading="lazy"
                      decoding="async"
                    >
                    <span><?= str_pad((string) $stageNumber, 2, '0', STR_PAD_LEFT) ?>. <?= htmlspecialchars($tableLabel, ENT_QUOTES, 'UTF-8') ?></span>
                  </div>
                </th>
                <td><?= htmlspecialchars($tableDescription, ENT_QUOTES, 'UTF-8') ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- QUALITY FLOW -->
    <section class="process-section process-section--soft" id="quality-flow" aria-labelledby="quality-flow-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Project Control</p>
        <h2 id="quality-flow-title">Workflow control points from inquiry to delivery</h2>
        <p>
          A strong workflow is built on clear control points. EDS supports customers by keeping technical,
          commercial, quality and logistics information aligned during the project lifecycle.
        </p>
      </div>

      <table class="process-spec-table workflow-spec-table" aria-label="EDS workflow control points">
        <tbody>
          <tr>
            <th scope="row">Inquiry and scope review</th>
            <td>Drawing, material, quantity, application, tolerance and delivery expectations are clarified before supplier selection.</td>
          </tr>
          <tr>
            <th scope="row">Engineering and process review</th>
            <td>Component requirements are matched with casting, forging, machining, finishing, assembly or supply chain options.</td>
          </tr>
          <tr>
            <th scope="row">Supplier coordination</th>
            <td>Qualified external suppliers are contacted and aligned with technical requirements, cost targets and lead time expectations.</td>
          </tr>
          <tr>
            <th scope="row">Production and quality follow-up</th>
            <td>Production status, inspection requirements, material certificates and dimensional reports are followed according to project scope.</td>
          </tr>
          <tr>
            <th scope="row">Logistics and delivery</th>
            <td>Packing, shipping, delivery documentation and communication are coordinated to support reliable final delivery.</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- RELATED -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Related EDS Support</p>
        <h2 id="related-title">Explore the services connected to the EDS workflow</h2>
        <p>
          Workflow efficiency depends on process selection, supplier coordination, quality control and supply chain
          planning. Explore related pages to understand these areas in more detail.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/casting-matrix">
          <h3>Casting Matrix</h3>
          <p>Compare casting processes and select the right route for geometry, material, volume and tolerance requirements.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/quality">
          <h3>Quality Support</h3>
          <p>See how certificates, inspection reports, traceability and non-conformity follow-up are coordinated.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/supply-chain">
          <h3>Supply Chain Support</h3>
          <p>Understand how EDS coordinates suppliers, logistics, delivery planning and recurring supply programs.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="process-section process-final-cta" aria-labelledby="workflow-cta-title">
      <div>
        <p class="process-eyebrow">Start a Structured Project</p>
        <h2 id="workflow-cta-title">Need a sourcing partner that can manage technical and operational complexity?</h2>
        <p>
          Send us your drawing, technical requirement or sourcing challenge. EDS can help review the project scope,
          define the right production route and coordinate the workflow from inquiry to delivery.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/contact">Discuss Your Project</a>
        <a class="process-btn process-btn--secondary" href="/about-us">Learn About EDS</a>
      </div>
    </section>

  </div>
</main>

<script type="application/ld+json">
<?= json_encode($workflowSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
<script type="application/ld+json">
<?= json_encode($workflowServiceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
