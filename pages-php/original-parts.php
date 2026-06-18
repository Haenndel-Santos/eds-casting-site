<?php
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../includes/content-loader.php';

/* Original Parts uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;

$pageTitle = 'Original Parts | Standard Industrial Components & Replacement Parts | EDS Casting & Forging';
$pageDescription = 'EDS supports original and standard industrial parts sourcing for cast, forged, machined and assembled components, combining technical review, supplier coordination, quality documentation and reliable supply follow-up.';

$originalPartsData = eds_load_data('original-parts.php', []);
$productGroups = eds_sort_by_order(eds_filter_public_items($originalPartsData['support_groups'] ?? []));

$partCategories = eds_sort_by_order(eds_filter_public_items($originalPartsData['part_categories'] ?? []));

$originalPartsSchemaItems = [];

foreach ($productGroups as $index => $group) {
  $originalPartsSchemaItems[] = [
    '@type' => 'ListItem',
    'position' => $index + 1,
    'name' => $group['title'],
    'description' => $group['short_description'] ?? '',
  ];
}

$originalPartsSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'CollectionPage',
  'name' => 'Original Parts and Standard Industrial Components',
  'description' => 'Original and standard industrial component sourcing support for cast, forged, machined and assembled parts.',
  'mainEntity' => [
    '@type' => 'ItemList',
    'itemListElement' => $originalPartsSchemaItems,
  ],
];

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page original-parts-page">

  <!-- HERO -->
  <section
    class="process-hero original-parts-hero"
    aria-labelledby="original-parts-hero-title"
    style="background-image: url('/assets/img/hero-img/edsbanner.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="original-parts-hero-title">Original Parts and Standard Industrial Components</h1>

      <p class="process-hero__summary">
        EDS supports industrial buyers with repeatable, technically controlled sourcing for original parts,
        replacement components and standard industrial parts based on drawings, specifications or existing references.
      </p>

      <div class="process-hero__actions" aria-label="Original parts page actions">
        <a class="process-btn process-btn--primary" href="/contact">Request Original Parts Support</a>
        <a class="process-btn process-btn--secondary" href="#part-categories">Explore Part Categories</a>
      </div>
    </div>
  </section>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="Original parts page navigation">
    <a href="#overview">Overview</a>
    <a href="#component-support">Support</a>
    <a href="#part-categories">Categories</a>
    <a href="#technical-review">Technical Review</a>
    <a href="#quality-control">Quality</a>
    <a href="#related">Related</a>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="overview" aria-labelledby="overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">Original Parts</p>
        <h2 id="overview-title">Reliable sourcing for repeatable industrial components</h2>
        <p>
          Original parts and standard industrial components often require more than a simple purchasing process.
          Material selection, manufacturing method, tolerances, surface treatment, inspection documents and supplier
          continuity all influence long-term availability and performance.
        </p>
        <p>
          EDS supports these requirements by coordinating technical review, supplier selection, production follow-up,
          quality documentation and logistics for cast, forged, machined and assembled components.
        </p>
        <p>
          This page is intended for buyers, engineers and maintenance teams looking for a controlled sourcing route
          for existing parts, replacement components or repeatable standard parts used in industrial applications.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="Original parts sourcing highlights">
        <article>
          <h3>Drawing-Based Sourcing</h3>
          <p>Parts can be reviewed based on drawings, specifications, samples or existing technical references.</p>
        </article>

        <article>
          <h3>Repeatable Supply</h3>
          <p>Supplier coordination and documentation help maintain consistent quality across repeat orders.</p>
        </article>

        <article>
          <h3>Quality Documentation</h3>
          <p>Material certificates, dimensional reports and traceability can be coordinated when required.</p>
        </article>
      </div>
    </section>

    <!-- COMPONENT SUPPORT -->
    <section class="process-section" id="component-support" aria-labelledby="component-support-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Component Support</p>
        <h2 id="component-support-title">Original parts support across casting, forging, machining and assemblies</h2>
        <p>
          EDS works with a qualified supplier network to support repeatable industrial components. The correct route
          depends on part geometry, material, tolerance, application, production volume and documentation requirements.
        </p>
      </div>

      <div class="original-parts-support-grid" aria-label="Original parts manufacturing support areas">
        <?php foreach ($productGroups as $group): ?>
          <article class="original-parts-support-card">
            <h3><?= htmlspecialchars($group['title'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p><?= htmlspecialchars($group['short_description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
            <a href="<?= htmlspecialchars($group['cta_url'] ?? '/contact', ENT_QUOTES, 'UTF-8') ?>">
              <?= htmlspecialchars($group['cta_label'] ?? 'Learn more', ENT_QUOTES, 'UTF-8') ?>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- PART CATEGORIES -->
    <section class="process-section process-section--soft" id="part-categories" aria-labelledby="part-categories-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Part Categories</p>
        <h2 id="part-categories-title">Examples of original and replacement parts EDS can support</h2>
        <p>
          The examples below represent typical component families where technical sourcing, supplier continuity and
          documentation control can create value. Final feasibility always depends on drawings, material requirements,
          tolerances, quantity and application conditions.
        </p>
      </div>

      <div class="original-parts-category-grid" aria-label="Original parts and replacement part categories">
        <?php foreach ($partCategories as $category): ?>
          <article class="original-parts-category-card">
            <h3><?= htmlspecialchars($category['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></h3>
            <p><?= htmlspecialchars($category['short_description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- TECHNICAL REVIEW -->
    <section class="process-section process-split" id="technical-review" aria-labelledby="technical-review-title">
      <div>
        <p class="process-eyebrow">Technical Review</p>
        <h2 id="technical-review-title">What we need to evaluate an original part request</h2>
        <p>
          To review an original part or replacement component properly, EDS needs enough technical information to
          understand the part function, manufacturing route and quality expectations. Drawings and specifications
          are always preferred, but samples or existing part references can also support the first discussion.
        </p>
        <p>
          Our team reviews geometry, material grade, tolerances, annual demand, expected lifetime, current sourcing
          challenge and possible cost or lead time improvements before coordinating supplier input.
        </p>
      </div>

      <aside class="process-callout process-callout--neutral" aria-label="Information needed for original parts quotation">
        <h3>Useful information to send</h3>
        <ul>
          <li>2D drawing or 3D model</li>
          <li>Material grade and standard</li>
          <li>Quantity and annual volume</li>
          <li>Surface treatment or coating requirement</li>
          <li>Inspection and certificate requirements</li>
          <li>Current part reference or sample information</li>
        </ul>
      </aside>
    </section>

    <!-- QUALITY CONTROL -->
    <section class="process-section" id="quality-control" aria-labelledby="quality-control-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Quality & Supply Control</p>
        <h2 id="quality-control-title">Keeping repeated parts consistent over time</h2>
        <p>
          For original parts and standard components, consistency is often the most important requirement. EDS helps
          coordinate the information and checks needed to keep future batches aligned with the approved technical scope.
        </p>
      </div>

      <table class="process-spec-table original-parts-spec-table" aria-label="Original parts quality and supply control factors">
        <tbody>
          <tr>
            <th scope="row">Technical baseline</th>
            <td>Drawing revision, material standard, tolerances, surface requirements and inspection scope are clarified before production.</td>
          </tr>
          <tr>
            <th scope="row">Supplier continuity</th>
            <td>Production partners are selected according to process capability, repeatability, communication and documentation expectations.</td>
          </tr>
          <tr>
            <th scope="row">Documentation package</th>
            <td>Material certificates, dimensional reports, inspection records and traceability documents can be coordinated when required.</td>
          </tr>
          <tr>
            <th scope="row">Repeat order control</th>
            <td>Approved specifications, supplier history and previous delivery feedback help support stable future supply.</td>
          </tr>
          <tr>
            <th scope="row">Logistics and stock support</th>
            <td>For recurring components, EDS can support delivery planning, warehousing options and supply chain coordination.</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- RELATED -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Related EDS Support</p>
        <h2 id="related-title">Explore services connected to original parts sourcing</h2>
        <p>
          Original parts sourcing often combines process selection, quality control and supply chain planning. These
          pages explain the EDS support areas connected to repeatable industrial component supply.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/casting-matrix">
          <h3>Casting Matrix</h3>
          <p>Compare casting methods and identify a suitable production route for geometry, material and volume.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/quality">
          <h3>Quality Support</h3>
          <p>Understand certificates, dimensional reports, traceability and supplier documentation follow-up.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/supply-chain">
          <h3>Supply Chain Support</h3>
          <p>Coordinate recurring orders, supplier follow-up, logistics, delivery planning and stock support.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="process-section process-final-cta" aria-labelledby="original-parts-cta-title">
      <div>
        <p class="process-eyebrow">Start an Original Parts Request</p>
        <h2 id="original-parts-cta-title">Need a reliable source for original, replacement or standard industrial parts?</h2>
        <p>
          Send us your drawing, sample reference, material requirement or annual demand. EDS can help review the
          technical scope, identify the correct manufacturing route and coordinate supplier follow-up.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/contact">Request Original Parts Support</a>
        <a class="process-btn process-btn--secondary" href="/projects">View Projects</a>
      </div>
    </section>

  </div>
</main>

<script type="application/ld+json">
<?= json_encode($originalPartsSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
