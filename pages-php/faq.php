<?php
require_once __DIR__ . '/../includes/seo.php';

/* FAQ uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;

$pageTitle = 'FAQ | Casting, Forging, Quality & Supply Chain Questions | EDS Casting & Forging';
$pageDescription = 'Find answers about EDS Casting & Forging, including casting and forging methods, materials, quality documentation, lead times, logistics, quotations and technical project support.';

require_once __DIR__ . '/../includes/content-loader.php';

$faqItems = eds_sort_by_order(eds_filter_public_items(eds_load_data('faq-items.php', [])));

$faqSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => array_map(function ($item) {
    return [
      '@type' => 'Question',
      'name' => $item['question'],
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => $item['answer'],
      ],
    ];
  }, $faqItems),
];

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page faq-page">

  <!-- HERO -->
  <section
    class="process-hero faq-hero"
    aria-labelledby="faq-hero-title"
    style="background-image: url('/assets/img/hero/faq-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="faq-hero-title">Frequently Asked Questions About EDS Casting &amp; Forging</h1>

      <p class="process-hero__summary">
        Find practical answers about casting, forging, machining, materials, quotations, quality documentation,
        logistics and how EDS supports industrial component sourcing projects.
      </p>

      <div class="process-hero__actions" aria-label="FAQ page actions">
        <a class="process-btn process-btn--primary" href="/contact">Ask a Technical Question</a>
        <a class="process-btn process-btn--secondary" href="/casting-matrix">Compare Casting Processes</a>
      </div>
    </div>
  </section>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="FAQ page navigation">
    <a href="#company">Company</a>
    <a href="#manufacturing">Manufacturing</a>
    <a href="#quotation">Quotation</a>
    <a href="#logistics">Logistics</a>
    <a href="#quality">Quality</a>
    <a href="#value-added">Value Added</a>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="overview" aria-labelledby="faq-overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">FAQ Overview</p>
        <h2 id="faq-overview-title">Clear answers for industrial buyers, engineers and sourcing teams</h2>
        <p>
          EDS supports customers with technical sourcing for industrial metal components. Many questions begin with
          process selection, material choice, documentation requirements, lead time, logistics or how to start a
          quotation request based on drawings and specifications.
        </p>
        <p>
          This FAQ page gives practical answers to the most common questions about our role, our supplier network,
          manufacturing routes, quality follow-up and value-added services. For project-specific advice, we recommend
          sharing your drawing package and application details through the contact form.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="FAQ support highlights">
        <article>
          <h3>Engineering Questions</h3>
          <p>Understand how EDS supports process selection, feasibility review and technical supplier coordination.</p>
        </article>

        <article>
          <h3>Quotation Preparation</h3>
          <p>Learn which documents and details help us review a request faster and more accurately.</p>
        </article>

        <article>
          <h3>Quality &amp; Logistics</h3>
          <p>See how documentation, inspection, shipping and stock support are handled during sourcing projects.</p>
        </article>
      </div>
    </section>

    <?php
      $categoryMap = [
        'Company & Project Support' => ['id' => 'company', 'label' => 'Company & Project Support'],
        'Materials & Manufacturing' => ['id' => 'manufacturing', 'label' => 'Materials & Manufacturing'],
        'Quotation & Technical Review' => ['id' => 'quotation', 'label' => 'Quotation & Technical Review'],
        'Lead Time & Logistics' => ['id' => 'logistics', 'label' => 'Lead Time & Logistics'],
        'Quality & Documentation' => ['id' => 'quality', 'label' => 'Quality & Documentation'],
        'Value-Added Services' => ['id' => 'value-added', 'label' => 'Value-Added Services'],
      ];
    ?>

    <?php foreach ($categoryMap as $categoryName => $categoryData): ?>
      <section class="process-section faq-section" id="<?= htmlspecialchars($categoryData['id'], ENT_QUOTES, 'UTF-8') ?>" aria-labelledby="<?= htmlspecialchars($categoryData['id'], ENT_QUOTES, 'UTF-8') ?>-title">
        <div class="process-section__header">
          <p class="process-eyebrow">FAQ Category</p>
          <h2 id="<?= htmlspecialchars($categoryData['id'], ENT_QUOTES, 'UTF-8') ?>-title"><?= htmlspecialchars($categoryData['label'], ENT_QUOTES, 'UTF-8') ?></h2>
        </div>

        <div class="faq-list">
          <?php foreach ($faqItems as $index => $item): ?>
            <?php if ($item['category'] !== $categoryName) continue; ?>
            <details class="faq-item">
              <summary>
                <span><?= htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8') ?></span>
              </summary>
              <div class="faq-answer">
                <p><?= htmlspecialchars($item['answer'], ENT_QUOTES, 'UTF-8') ?></p>
              </div>
            </details>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endforeach; ?>

    <!-- QUICK LINKS -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Related EDS Pages</p>
        <h2 id="related-title">Explore technical pages connected to these questions</h2>
        <p>
          If you need more detailed information, these pages explain EDS capabilities, process selection,
          quality coordination and project workflow in more depth.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/casting-matrix">
          <h3>Casting Matrix</h3>
          <p>Compare casting routes based on geometry, material, tolerance, tooling and production volume.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/forging">
          <h3>Forging Solutions</h3>
          <p>Explore forged component sourcing for applications requiring strength and mechanical reliability.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/quality">
          <h3>Quality Support</h3>
          <p>Learn how EDS coordinates certificates, dimensional reports, inspections and supplier documentation.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="process-section process-final-cta" aria-labelledby="faq-cta-title">
      <div>
        <p class="process-eyebrow">Still Have Questions?</p>
        <h2 id="faq-cta-title">Need project-specific advice for a casting, forging or machined component?</h2>
        <p>
          Send us your drawing, material specification, expected quantity or technical question. EDS can help review
          the manufacturing route, supplier fit, quality requirements and next steps for your project.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/contact">Contact EDS</a>
        <a class="process-btn process-btn--secondary" href="/projects">View Projects</a>
      </div>
    </section>

  </div>
</main>

<script type="application/ld+json">
<?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
