<?php
$homeSourcingRisks = [
  [
    'anchor' => 'supplier-bottleneck',
    'title' => 'Current supplier becomes a bottleneck',
    'summary' => 'Delays, unclear feedback or inconsistent capacity can turn a known component into a production risk.',
  ],
  [
    'anchor' => 'drawing-interpretation',
    'title' => 'Drawings are not translated into production reality',
    'summary' => 'Material, tolerances, inspection needs and manufacturing route must be understood before a supplier is selected.',
  ],
  [
    'anchor' => 'late-quality-issues',
    'title' => 'Quality issues appear too late',
    'summary' => 'If documentation, inspection and production follow-up are weak, problems are often discovered after time has already been lost.',
  ],
  [
    'anchor' => 'second-source-control',
    'title' => 'A second source is needed without losing control',
    'summary' => 'Alternative sourcing must protect the technical requirements, not only deliver another quotation.',
  ],
];

$homeSourcingSteps = [
  'Drawing review',
  'Supplier route',
  'Production follow-up',
  'Documentation',
  'Logistics coordination',
  'Recurring supply',
];
?>

<section class="home-sourcing-section" id="engineering-driven-sourcing" aria-labelledby="home-commercial-title">
  <div class="home-sourcing-section__heading">
    <div class="home-sourcing-section__eyebrow">Engineering-Driven Sourcing</div>
    <h2 id="home-commercial-title">When metal component sourcing becomes a technical risk</h2>
  </div>

  <div class="home-sourcing-section__inner">
    <div class="home-sourcing-section__content">
      <p class="home-sourcing-section__lead">
        For cast and forged parts, the risk is rarely just finding another supplier. The real challenge is whether
        the drawing, material, process route, inspection requirements and delivery expectations are understood and
        controlled before production starts.
      </p>
      <p>
        EDS acts as the technical and commercial coordination point between customer and supplier, helping industrial
        buyers move from sourcing uncertainty to a controlled supply route.
      </p>

      <div class="home-sourcing-process" aria-label="How EDS reduces sourcing risk">
        <div class="home-sourcing-process__label">How EDS reduces the risk</div>
        <ol class="home-sourcing-process__steps">
          <?php foreach ($homeSourcingSteps as $step): ?>
            <li><?= htmlspecialchars($step, ENT_QUOTES, 'UTF-8') ?></li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>

    <div class="home-sourcing-section__risk-panel" aria-label="Common sourcing risks EDS helps control">
      <?php foreach ($homeSourcingRisks as $risk): ?>
        <article class="home-sourcing-risk" id="<?= htmlspecialchars($risk['anchor'], ENT_QUOTES, 'UTF-8') ?>">
          <h3><?= htmlspecialchars($risk['title'], ENT_QUOTES, 'UTF-8') ?></h3>
          <p><?= htmlspecialchars($risk['summary'], ENT_QUOTES, 'UTF-8') ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="home-sourcing-section__actions" aria-label="Sourcing support actions">
    <a
      class="home-sourcing-section__action home-sourcing-section__action--primary"
      href="/contact#sourcing-challenge"
      data-eds-track
      data-eds-event="commercial_cta_click"
      data-eds-label="home_discuss_sourcing_risk"
      data-eds-category="home_commercial_support"
    >Discuss a sourcing risk</a>
    <a
      class="home-sourcing-section__action"
      href="/workflow#common-sourcing-challenges"
      data-eds-track
      data-eds-event="internal_strategy_link_click"
      data-eds-label="home_see_sourcing_workflow"
      data-eds-category="home_commercial_support"
    >See the sourcing workflow</a>
  </div>
</section>
