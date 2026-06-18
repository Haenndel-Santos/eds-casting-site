<?php
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../includes/content-loader.php';

$useMainPagesCss = false;

$pageTitle = 'Technical Project Cases | EDS Casting & Forging';
$pageDescription = 'Review EDS technical project examples focused on engineering review, sourcing coordination, quality follow-up and measurable project outcomes.';

$projectCases = eds_load_data('project-cases.php', []);
$productExamples = eds_load_data('product-examples.php', []);
$componentExamples = eds_load_data('component-examples.php', []);
$outcomeFramework = eds_load_data('project-outcome-framework.php', []);
$outcomeFrameworkById = [];

foreach ($outcomeFramework as $outcome) {
  if (!empty($outcome['id'])) {
    $outcomeFrameworkById[$outcome['id']] = $outcome;
  }
}

function eds_projects_text($value): string {
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function eds_projects_image_path($path): string {
  if (!is_string($path) || trim($path) === '') {
    return '';
  }

  $relativePath = str_starts_with($path, '/') ? $path : '/' . $path;
  $filesystemPath = dirname(__DIR__) . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

  return is_file($filesystemPath) ? $relativePath : '';
}

function eds_projects_metric_label(string $key): string {
  $labels = [
    'weight_before' => 'Weight before',
    'weight_after' => 'Weight after',
    'weight_reduction_percent' => 'Weight reduction',
    'cost_reduction_percent' => 'Cost reduction',
    'stress_optimization_percent' => 'Stress optimization',
    'deadline_weeks' => 'Project window',
    'assembly_improvement' => 'Assembly improvement',
  ];

  return $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
}

function eds_projects_metric_value(string $key, $value): string {
  if ($value === '' || $value === null) {
    return '';
  }

  if (in_array($key, ['weight_reduction_percent', 'cost_reduction_percent', 'stress_optimization_percent'], true)) {
    return (string) $value . '%';
  }

  if ($key === 'deadline_weeks') {
    return (string) $value . ' weeks';
  }

  return (string) $value;
}

function eds_projects_metrics_confirmed(array $case): bool {
  $note = strtolower((string) ($case['metric_publication_note'] ?? ''));
  $approvalNote = strtolower((string) ($case['approval_notes'] ?? ''));

  if (str_contains($note, 'must be confirmed') || str_contains($approvalNote, 'confirm technical accuracy')) {
    return false;
  }

  return true;
}

function eds_projects_field_for_case(array $case): string {
  $haystack = strtolower(implode(' ', [
    $case['industry'] ?? '',
    $case['component_type'] ?? '',
    $case['title'] ?? '',
    $case['process'] ?? '',
  ]));

  if (str_contains($haystack, 'rail')) {
    return 'railway';
  }

  if (str_contains($haystack, 'agricultural') || str_contains($haystack, 'forage') || str_contains($haystack, 'mower') || str_contains($haystack, 'tine')) {
    return 'agricultural-machinery';
  }

  if (str_contains($haystack, 'construction') || str_contains($haystack, 'foundation') || str_contains($haystack, 'piling') || str_contains($haystack, 'coupler')) {
    return 'construction-equipment';
  }

  if (str_contains($haystack, 'automotive') || str_contains($haystack, 'mobility') || str_contains($haystack, 'trailer') || str_contains($haystack, 'transport')) {
    return 'automotive-mobility';
  }

  if (str_contains($haystack, 'energy') || str_contains($haystack, 'infrastructure') || str_contains($haystack, 'guide rail')) {
    return 'energy-infrastructure';
  }

  return 'industrial-machinery';
}

function eds_projects_field_label(string $field): string {
  $labels = [
    'railway' => 'Railway',
    'agricultural-machinery' => 'Agricultural Machinery',
    'construction-equipment' => 'Construction Equipment',
    'industrial-machinery' => 'Industrial Machinery',
    'automotive-mobility' => 'Automotive / Mobility',
    'energy-infrastructure' => 'Energy / Infrastructure',
    'original-parts' => 'Original Parts',
  ];

  return $labels[$field] ?? 'Industrial Machinery';
}

$publicProjectCases = array_values(array_filter($projectCases, function ($case) {
  $requiredPublicFields = ['id', 'title', 'challenge', 'eds_contribution', 'result'];

  foreach ($requiredPublicFields as $field) {
    if (trim((string) ($case[$field] ?? '')) === '') {
      return false;
    }
  }

  if (eds_projects_image_path($case['image'] ?? null) === '') {
    return false;
  }

  return eds_project_is_visible($case, 'show_on_projects');
}));

$projectCards = [];

foreach ($publicProjectCases as $case) {
  $case['card_type'] = 'project_case';
  $case['field'] = !empty($case['field']) ? (string) $case['field'] : eds_projects_field_for_case($case);
  $case['field_label'] = !empty($case['field_label']) ? (string) $case['field_label'] : eds_projects_field_label($case['field']);
  $case['is_preview'] = false;
  $projectCards[] = $case;
}

$componentExampleCards = eds_sort_by_order(array_values(array_filter($componentExamples, function ($example) {
  if (!is_array($example) || ($example['can_publish'] ?? false) !== true) {
    return false;
  }

  if (trim((string) ($example['title'] ?? '')) === '' || trim((string) ($example['summary'] ?? '')) === '') {
    return false;
  }

  return eds_projects_image_path($example['image'] ?? null) !== '';
})));

if (defined('EDS_LOCAL_PREVIEW') && EDS_LOCAL_PREVIEW) {
  foreach ($productExamples as $product) {
    if (trim((string) ($product['title'] ?? '')) === '' || trim((string) ($product['summary'] ?? '')) === '') {
      continue;
    }

    if (eds_projects_image_path($product['image'] ?? null) === '') {
      continue;
    }

    $projectCards[] = [
      'id' => 'original-part-' . ($product['id'] ?? md5($product['title'])),
      'title' => $product['title'] ?? '',
      'approval_status' => $product['approval_status'] ?? 'draft',
      'industry' => 'Original Parts',
      'field' => 'original-parts',
      'field_label' => 'Original Parts',
      'component_type' => $product['category'] ?? 'Original part concept',
      'material' => 'Validate before publication',
      'process' => 'Original part / standard component concept',
      'challenge' => 'Original part data is kept as draft source material until EDS confirms technical values, images and commercial permission.',
      'eds_contribution' => 'EDS can review whether a standard or original part concept fits the technical application, assembly conditions and sourcing route.',
      'quality_documentation' => 'Draft data. Validate technical values, load assumptions and image permission before publication.',
      'result' => $product['summary'] ?? '',
      'highlights' => array_slice($product['key_characteristics'] ?? [], 0, 4),
      'primary_outcome' => 'assembly-simplification',
      'outcome_categories' => ['assembly-simplification', 'supply-route-control'],
      'public_summary' => $product['summary'] ?? '',
      'before_state' => 'Application-specific original part requirement to be confirmed.',
      'after_state' => 'Potential standard or original part route to be validated by EDS.',
      'metrics' => [],
      'metric_publication_note' => 'Draft original part data. Validate before publication.',
      'approval_notes' => 'Local preview only. Product examples remain internal until EDS completes technical and commercial approval.',
      'image' => $product['image'] ?? null,
      'image_alt' => $product['image_alt'] ?? ($product['title'] ?? 'Original part concept'),
      'public_note' => $product['public_note'] ?? 'Draft data. Validate before publication.',
      'client_name_public' => false,
      'client_name' => '',
      'can_publish' => false,
      'card_type' => 'original_part',
      'is_preview' => true,
    ];
  }
}

$componentExampleFilters = [
  'all' => 'Show all',
  'railway' => 'Railway',
  'oil-gas' => 'Oil & Gas',
  'construction-equipment' => 'Construction Equipment',
  'hydraulics' => 'Hydraulics',
  'offshore' => 'Offshore',
  'demolition' => 'Demolition',
  'heavy-equipment' => 'Heavy Equipment',
];

$projectsSchemaItems = array_map(function ($case, $index) {
  return [
    '@type' => 'ListItem',
    'position' => $index + 1,
    'name' => $case['title'] ?? '',
    'description' => $case['public_summary'] ?? $case['result'] ?? '',
    'url' => 'https://www.edscasting.com/projects#' . ($case['id'] ?? 'project-case'),
  ];
}, $publicProjectCases, array_keys($publicProjectCases));

$projectsSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'CollectionPage',
  'name' => 'EDS Technical Project Cases',
  'description' => 'Technical project examples showing EDS engineering review, sourcing coordination, quality follow-up and project outcomes.',
  'mainEntity' => [
    '@type' => 'ItemList',
    'itemListElement' => $projectsSchemaItems,
  ],
];

$projectsServiceSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'Service',
  'name' => 'Technical Sourcing and Project Coordination',
  'provider' => [
    '@type' => 'Organization',
    'name' => 'EDS Casting & Forging B.V.',
    'url' => 'https://www.edscasting.com',
  ],
  'serviceType' => 'Engineering-driven sourcing, supplier coordination and quality follow-up for cast, forged, machined and finished components',
  'areaServed' => 'Europe',
  'description' => 'EDS supports technical sourcing, redesign and project coordination without manufacturing parts in-house.',
];

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page projects-page" id="projects-page">
  <section
    class="process-hero projects-hero"
    aria-labelledby="projects-hero-title"
    style="background-image: url('/assets/img/hero/projects-v2-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>
    <div class="process-hero__content">
      <h1 id="projects-hero-title">Technical Projects and Engineering Case Studies</h1>
      <p class="process-hero__summary">
        Review compact project examples showing how EDS supports engineering review, sourcing coordination,
        supplier follow-up, quality documentation and measurable industrial component outcomes.
      </p>
      <div class="process-hero__actions" aria-label="Projects page actions">
        <a class="process-btn process-btn--primary" href="/contact" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="projects_hero_request_quotation" data-eds-category="projects_hero">Request a Quotation</a>
        <a class="process-btn process-btn--secondary" href="#project-cases" data-eds-track data-eds-event="internal_strategy_link_click" data-eds-label="projects_hero_view_project_cases" data-eds-category="projects_hero">View Project Cases</a>
      </div>
    </div>
  </section>

  <?php
    $edsBreadcrumbItems = [
      ['label' => 'Home', 'url' => '/'],
      ['label' => 'Projects', 'url' => '/projects'],
    ];
    include __DIR__ . '/../includes/breadcrumbs.php';
  ?>

  <nav class="process-anchor-nav projects-anchor-nav" aria-label="Projects page navigation">
    <a href="#overview">Overview</a>
    <a href="#component-examples">Component Examples</a>
    <a href="#case-structure">Case Structure</a>
    <a href="#quality-supply-control">Quality &amp; Supply Control</a>
    <a href="#related-capabilities">Related Capabilities</a>
    <a href="#contact">Contact</a>
  </nav>

  <div class="process-content">
    <section class="process-section projects-overview" id="overview" aria-labelledby="projects-overview-title">
      <div class="projects-section-header projects-section-header--center">
        <p class="process-eyebrow">Overview</p>
        <h2 id="projects-overview-title">Engineering-driven project</h2>
        <p>
          These cases summarize how EDS reviews technical requirements, evaluates manufacturing routes,
          coordinates external suppliers and follows quality and delivery expectations for industrial components.
        </p>
      </div>

      <div class="projects-value-grid" aria-label="EDS project value summary">
        <article>
          <h3>Engineering review</h3>
          <p>Drawings, load context, material choice and manufacturability are reviewed before supplier alignment.</p>
        </article>
        <article>
          <h3>Sourcing coordination</h3>
          <p>EDS connects technical requirements with suitable casting, forging, machining and finishing partners.</p>
        </article>
        <article>
          <h3>Quality and delivery control</h3>
          <p>Inspection expectations, certificates, reporting and delivery planning are coordinated through the project.</p>
        </article>
      </div>
    </section>

    <section class="process-section projects-cases-section" id="project-cases" aria-labelledby="project-cases-title">
      <div class="projects-projects-heading">
        <h2>EDS Projects</h2>
      </div>

       <div class="projects-section-header projects-section-header--center">
       
        <h2 id="project-cases-title">Compact technical project review</h2>
        <p>
          Each card starts with the key technical facts. Expand a card to review the challenge, before/after context,
          EDS contribution, material and process details, metrics and validation notes.
        </p>
        <p class="process-eyebrow">Project Cases</p>
      </div>

          
      <div class="projects-case-list">
        <?php foreach ($projectCards as $case): ?>
          <?php
            $caseId = preg_replace('/[^a-z0-9-]/', '-', strtolower((string) ($case['id'] ?? 'project-case')));
            $detailsId = $caseId . '-details';
            $imagePath = eds_projects_image_path($case['image'] ?? null);
            $metrics = is_array($case['metrics'] ?? null) ? $case['metrics'] : [];
            $highlights = is_array($case['highlights'] ?? null) ? $case['highlights'] : [];
            $outcomeIds = is_array($case['outcome_categories'] ?? null) ? $case['outcome_categories'] : [];
            $field = $case['field'] ?? 'industrial-machinery';
            $isPreview = (bool) ($case['is_preview'] ?? false);
            $metricsConfirmed = $isPreview || eds_projects_metrics_confirmed($case);
            if (!$metricsConfirmed) {
              $metrics = [];
              $highlights = [];
            }
          ?>
          <article class="projects-case-card" id="<?= eds_projects_text($caseId) ?>" data-project-card data-project-field="<?= eds_projects_text($field) ?>">
            <div class="projects-case-card__media">
              <img src="<?= eds_projects_text($imagePath) ?>" alt="<?= eds_projects_text($case['image_alt'] ?? $case['title'] ?? '') ?>" loading="lazy" decoding="async">
            </div>

            <div class="projects-case-card__content">
              <div class="projects-case-card__topline">
                <span><?= eds_projects_text($case['field_label'] ?? eds_projects_field_label($field)) ?></span>
                <?php if ($isPreview): ?>
                  <span>Draft data</span>
                <?php endif; ?>
              </div>

              <h3><?= eds_projects_text($case['title'] ?? '') ?></h3>

              <?php if (!empty($case['public_summary'])): ?>
                <p class="projects-case-card__summary"><?= eds_projects_text($case['public_summary']) ?></p>
              <?php endif; ?>

              <dl class="projects-case-facts">
                <?php if (!empty($case['component_type'])): ?>
                  <div>
                    <dt>Component</dt>
                    <dd><?= eds_projects_text($case['component_type']) ?></dd>
                  </div>
                <?php endif; ?>
                <?php if (!empty($case['material'])): ?>
                  <div>
                    <dt>Material</dt>
                    <dd><?= eds_projects_text($case['material']) ?></dd>
                  </div>
                <?php endif; ?>
                <?php if (!empty($case['process'])): ?>
                  <div>
                    <dt>Process</dt>
                    <dd><?= eds_projects_text($case['process']) ?></dd>
                  </div>
                <?php endif; ?>
              </dl>

              <?php if (!empty($outcomeIds)): ?>
                <div class="projects-case-tags" aria-label="Main outcome tags">
                  <?php foreach (array_slice($outcomeIds, 0, 4) as $outcomeId): ?>
                    <?php $outcomeTitle = $outcomeFrameworkById[$outcomeId]['title'] ?? $outcomeId; ?>
                    <span><?= eds_projects_text($outcomeTitle) ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <?php if (!empty($metrics)): ?>
                <div class="projects-case-metrics" aria-label="Key metrics">
                  <?php foreach (array_slice($metrics, 0, 4, true) as $metricKey => $metricValue): ?>
                    <?php $displayValue = eds_projects_metric_value((string) $metricKey, $metricValue); ?>
                    <?php if ($displayValue !== ''): ?>
                      <span><strong><?= eds_projects_text($displayValue) ?></strong><?= eds_projects_text(eds_projects_metric_label((string) $metricKey)) ?></span>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <div class="projects-case-actions">
                <button class="projects-case-toggle" type="button" aria-expanded="false" aria-controls="<?= eds_projects_text($detailsId) ?>" data-project-toggle>
                  Show technical details
                </button>
                <a class="projects-case-contact" href="/contact" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="<?= eds_projects_text($caseId) ?>" data-eds-category="project_case_card">Discuss a similar project</a>
              </div>

              <div class="projects-case-details" id="<?= eds_projects_text($detailsId) ?>" hidden>
                <div class="projects-case-detail-grid">
                  <section>
                    <h4>Technical challenge</h4>
                    <p><?= eds_projects_text($case['challenge'] ?? '') ?></p>
                  </section>

                  <section>
                    <h4>Before / after</h4>
                    <p><strong>Before:</strong> <?= eds_projects_text($case['before_state'] ?? 'To be validated.') ?></p>
                    <p><strong>After:</strong> <?= eds_projects_text($case['after_state'] ?? 'To be validated.') ?></p>
                  </section>

                  <section>
                    <h4>EDS contribution</h4>
                    <p><?= eds_projects_text($case['eds_contribution'] ?? '') ?></p>
                  </section>

                  <section>
                    <h4>Material and process details</h4>
                    <p><strong>Material:</strong> <?= eds_projects_text($case['material'] ?? '') ?></p>
                    <p><strong>Process:</strong> <?= eds_projects_text($case['process'] ?? '') ?></p>
                  </section>

                  <?php if ($metricsConfirmed && !empty($metrics)): ?>
                    <section>
                      <h4>Outcome metrics</h4>
                      <ul>
                        <?php foreach ($metrics as $metricKey => $metricValue): ?>
                          <?php $displayValue = eds_projects_metric_value((string) $metricKey, $metricValue); ?>
                          <?php if ($displayValue !== ''): ?>
                            <li><strong><?= eds_projects_text(eds_projects_metric_label((string) $metricKey)) ?>:</strong> <?= eds_projects_text($displayValue) ?></li>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                    </section>
                  <?php endif; ?>

                  <?php if ($metricsConfirmed && !empty($highlights)): ?>
                    <section>
                      <h4>Outcome highlights</h4>
                      <ul>
                        <?php foreach ($highlights as $highlight): ?>
                          <li><?= eds_projects_text($highlight) ?></li>
                        <?php endforeach; ?>
                      </ul>
                    </section>
                  <?php endif; ?>

                  <?php if ($isPreview): ?>
                    <section>
                      <h4>Approval and validation notes</h4>
                      <p><?= eds_projects_text($case['public_note'] ?? 'Validate before publication.') ?></p>
                      <?php if (!empty($case['metric_publication_note'])): ?>
                        <p><?= eds_projects_text($case['metric_publication_note']) ?></p>
                      <?php endif; ?>
                      <?php if (!empty($case['approval_notes'])): ?>
                        <p><?= eds_projects_text($case['approval_notes']) ?></p>
                      <?php endif; ?>
                    </section>
                  <?php endif; ?>
                </div>

                <button class="projects-case-less" type="button" data-project-collapse aria-controls="<?= eds_projects_text($detailsId) ?>">
                  Show less
                </button>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="projects-show-more-wrap" data-project-show-more-wrap hidden>
        <button class="projects-show-more-btn" type="button" data-project-show-more>
          Show more projects
        </button>
        <a
          class="projects-send-project-cta"
          href="/contact"
          data-project-end-cta
          data-eds-track
          data-eds-event="commercial_cta_click"
          data-eds-label="projects_cases_send_project_to_eds"
          data-eds-category="projects_cases"
          hidden
        >
          Send your project to EDS
        </a>
      </div>
    </section>

    <?php if (!empty($componentExampleCards)): ?>
      <section class="process-section projects-component-examples" id="component-examples" aria-labelledby="component-examples-title">
        <div class="projects-section-header projects-section-header--center">
          <p class="process-eyebrow">Component Examples</p>
          <h2 id="component-examples-title">Simplified examples by sector</h2>
          <p>
            These examples show individual components EDS can support across specific industrial sectors.
            They are intentionally shorter than full case studies and focus on part type, material, weight,
            finish and application context.
          </p>
        </div>

        <div class="projects-component-filters" aria-label="Filter component examples by sector">
          <?php foreach ($componentExampleFilters as $filterId => $filterLabel): ?>
            <button
              class="projects-component-filter<?= $filterId === 'all' ? ' is-active' : '' ?>"
              type="button"
              data-component-filter="<?= eds_projects_text($filterId) ?>"
              aria-pressed="<?= $filterId === 'all' ? 'true' : 'false' ?>"
            ><?= eds_projects_text($filterLabel) ?></button>
          <?php endforeach; ?>
        </div>

        <div class="projects-component-grid">
          <?php foreach ($componentExampleCards as $example): ?>
            <?php
              $exampleId = preg_replace('/[^a-z0-9-]/', '-', strtolower((string) ($example['id'] ?? 'component-example')));
              $exampleImagePath = eds_projects_image_path($example['image'] ?? null);
              $exampleField = (string) ($example['field'] ?? 'industrial-machinery');
            ?>
            <article class="projects-component-card" id="<?= eds_projects_text($exampleId) ?>" data-component-card data-component-field="<?= eds_projects_text($exampleField) ?>">
              <div class="projects-component-card__image">
                <img src="<?= eds_projects_text($exampleImagePath) ?>" alt="<?= eds_projects_text($example['image_alt'] ?? $example['title'] ?? '') ?>" loading="lazy" decoding="async">
              </div>
              <div class="projects-component-card__body">
                <div class="projects-component-card__topline">
                  <span><?= eds_projects_text($example['field_label'] ?? $example['sector'] ?? 'Industrial') ?></span>
                  <?php if (!empty($example['sector']) && ($example['sector'] !== ($example['field_label'] ?? ''))): ?>
                    <span><?= eds_projects_text($example['sector']) ?></span>
                  <?php endif; ?>
                </div>
                <h3><?= eds_projects_text($example['title'] ?? '') ?></h3>
                <p><?= eds_projects_text($example['summary'] ?? '') ?></p>

                <dl class="projects-component-specs">
                  <?php if (!empty($example['component_type'])): ?>
                    <div>
                      <dt>Part type</dt>
                      <dd><?= eds_projects_text($example['component_type']) ?></dd>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($example['material'])): ?>
                    <div>
                      <dt>Material</dt>
                      <dd><?= eds_projects_text($example['material']) ?></dd>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($example['weight'])): ?>
                    <div>
                      <dt>Weight</dt>
                      <dd><?= eds_projects_text($example['weight']) ?></dd>
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($example['finish'])): ?>
                    <div>
                      <dt>Finish</dt>
                      <dd><?= eds_projects_text($example['finish']) ?></dd>
                    </div>
                  <?php endif; ?>
                </dl>

                <?php if (!empty($example['notes'])): ?>
                  <p class="projects-component-card__note"><?= eds_projects_text($example['notes']) ?></p>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="projects-show-more-wrap" data-component-show-more-wrap hidden>
          <button class="projects-show-more-btn" type="button" data-component-show-more>
            Show more components
          </button>
        </div>
      </section>
    <?php endif; ?>

    <section class="process-section projects-text-section" id="case-structure" aria-labelledby="case-structure-title">
      <div class="projects-section-header">
        <p class="process-eyebrow">Case Structure</p>
        <h2 id="case-structure-title">How EDS structures project examples</h2>
        <p>
          EDS project examples are reviewed internally before publication. A useful case should make the technical
          challenge clear, explain the material and process choice, describe the sourcing route, show quality
          documentation expectations, include delivery or logistics control where relevant and summarize measurable
          outcomes only when those values are approved for use.
        </p>
      </div>
      <ul class="projects-compact-list">
        <li>Technical challenge</li>
        <li>Material and process choice</li>
        <li>Sourcing route</li>
        <li>Quality documentation</li>
        <li>Delivery and logistics control</li>
        <li>Measurable outcome</li>
      </ul>
    </section>

    <section class="process-section process-section--soft projects-text-section" id="quality-supply-control" aria-labelledby="quality-supply-control-title">
      <div class="projects-section-header">
        <p class="process-eyebrow">Quality &amp; Supply Control</p>
        <h2 id="quality-supply-control-title">Project control beyond the first quotation</h2>
        <p>
          EDS is not a foundry and does not manufacture parts in-house. Our role is to coordinate the technical and
          supply process: engineering review, supplier alignment, documentation checks, inspection follow-up, material
          certificates, measurement reports, packing requirements and logistics coordination. This gives customers one
          technically informed partner for sourcing and follow-up.
        </p>
      </div>
    </section>

    <section class="process-section process-section--dark" id="related-capabilities" aria-labelledby="related-capabilities-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Related Capabilities</p>
        <h2 id="related-capabilities-title">Capabilities behind the project work</h2>
      </div>
      <div class="process-related-grid projects-related-grid">
        <a class="process-related-card" href="/casting-matrix">
          <h3>Casting</h3>
          <p>Process selection and sourcing for cast components.</p>
          <span>Learn more</span>
        </a>
        <a class="process-related-card" href="/forging">
          <h3>Forging</h3>
          <p>Forged component sourcing for strength-critical applications.</p>
          <span>Learn more</span>
        </a>
        <a class="process-related-card" href="/machining">
          <h3>Machining</h3>
          <p>Machining coordination after casting or forging.</p>
          <span>Learn more</span>
        </a>
        <a class="process-related-card" href="/surface-finishing">
          <h3>Surface Finishing</h3>
          <p>Coating, finishing and final treatment coordination.</p>
          <span>Learn more</span>
        </a>
        <a class="process-related-card" href="/supply-chain">
          <h3>Supply Chain Support</h3>
          <p>Delivery planning and supply chain follow-up.</p>
          <span>Learn more</span>
        </a>
        <a class="process-related-card" href="/quality">
          <h3>Quality</h3>
          <p>Certificates, inspections, measurement reports and traceability.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <section class="process-section process-final-cta" id="contact" aria-labelledby="projects-cta-title">
      <div>
        <p class="process-eyebrow">Contact</p>
        <h2 id="projects-cta-title">Discuss a technical sourcing or redesign project with EDS</h2>
        <p>
          Share your drawing, requirements or sourcing challenge and our team will review how EDS can support the next step.
        </p>
      </div>
      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/contact" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="projects_final_contact_eds" data-eds-category="projects_final_cta">Contact EDS</a>
      </div>
    </section>
  </div>
</main>

<script type="application/ld+json">
<?= json_encode($projectsSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
<script type="application/ld+json">
<?= json_encode($projectsServiceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
<script src="<?= BASE_URL_NORM ?>/assets/js/projects.js?v=<?= $assetVer ?>" defer></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
