<?php
require_once __DIR__ . '/../includes/seo.php';

/* Quality uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;

$pageTitle = 'Quality Control & Supplier Risk Reduction | EDS Casting & Forging';
$pageDescription = 'EDS supports supplier risk reduction through drawing review, quality documentation follow-up, inspection coordination and clear supplier communication.';

$qualitySchema = [
  '@context' => 'https://schema.org',
  '@type' => 'Service',
  'name' => 'Quality Assurance and Documentation Support for Industrial Components',
  'provider' => [
    '@type' => 'Organization',
    'name' => 'EDS Casting & Forging B.V.',
    'url' => 'https://www.edscasting.com',
  ],
  'serviceType' => 'Quality Assurance, Supplier Follow-Up and Technical Documentation',
  'areaServed' => 'Europe',
  'description' => 'Quality assurance support for casting, forging, machining and value-added manufacturing projects, including supplier qualification, dimensional inspection coordination, material certificates, traceability and documentation follow-up.',
];

$qualityFaqs = [
  [
    'question' => 'Does EDS manufacture the parts itself?',
    'answer' => 'No. EDS does not operate its own foundry or forging facility. We work with selected manufacturing partners and support customers through engineering review, supplier coordination, quality follow-up and supply chain communication.',
  ],
  [
    'question' => 'How does EDS reduce supplier risk?',
    'answer' => 'EDS reduces supplier risk by reviewing technical requirements early, helping select suitable suppliers, coordinating production communication and following up on quality documentation before delivery.',
  ],
  [
    'question' => 'Can EDS coordinate material certificates and dimensional reports?',
    'answer' => 'Yes. When required by the project, EDS can coordinate material certificates, dimensional reports, inspection records, coating documentation and related quality files with external suppliers.',
  ],
  [
    'question' => 'Can EDS help with second sourcing?',
    'answer' => 'Yes. When a customer needs an alternative supplier for cast or forged components, EDS can support the technical and sourcing process needed to evaluate suitable production options.',
  ],
  [
    'question' => 'Does EDS replace the customer internal quality department?',
    'answer' => 'No. EDS supports the sourcing and quality follow-up process, but the final approval criteria remain based on customer requirements, drawings, specifications and agreed documentation.',
  ],
];

$qualityFaqSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'FAQPage',
  'mainEntity' => array_map(function ($faq) {
    return [
      '@type' => 'Question',
      'name' => $faq['question'],
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => $faq['answer'],
      ],
    ];
  }, $qualityFaqs),
];

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page quality-page">

  <!-- HERO -->
  <section
    class="process-hero quality-hero"
    aria-labelledby="quality-hero-title"
    style="background-image: url('/assets/img/hero/quality-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="quality-hero-title">Quality Assurance for Cast, Forged and Machined Components</h1>

      <p class="process-hero__summary">
        EDS supports industrial customers with supplier qualification, dimensional inspection follow-up,
        material certificates, traceability, quality documentation and corrective action coordination.
      </p>

      <div class="process-hero__actions" aria-label="Quality page actions">
        <a class="process-btn process-btn--primary" href="/contact#sourcing-challenge" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="quality_hero_discuss_requirements" data-eds-category="quality_hero">Discuss Quality Requirements</a>
        <a class="process-btn process-btn--secondary" href="#quality-documentation" data-eds-track data-eds-event="internal_strategy_link_click" data-eds-label="quality_hero_documentation" data-eds-category="quality_hero">View Documentation Support</a>
      </div>
    </div>
  </section>

  <?php
    $edsBreadcrumbItems = [
      ['label' => 'Home', 'url' => '/'],
      ['label' => 'Quality', 'url' => '/quality'],
    ];
    include __DIR__ . '/../includes/breadcrumbs.php';
  ?>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="Quality page navigation">
    <a href="#overview">Overview</a>
    <a href="#supplier-risk-reduction">Risk Reduction</a>
    <a href="#supplier-qualification">Suppliers</a>
    <a href="#inspection">Inspection</a>
    <a href="#quality-documentation">Documentation</a>
    <a href="#non-conformity">Non-Conformity</a>
    <a href="#quality-faq">FAQ</a>
    <a href="#related">Related</a>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="overview" aria-labelledby="overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">Quality Assurance</p>
        <h2 id="overview-title">Quality control starts before production begins</h2>
        <p>
          Reliable industrial components depend on more than the final inspection. Quality starts with a clear
          technical specification, the right supplier capability, suitable material selection, realistic tolerances,
          controlled production steps and complete documentation before shipment.
        </p>
        <p>
          EDS does not operate its own foundry or forging plant. Instead, we act as an engineering and trading
          partner that coordinates production through qualified external suppliers. This makes supplier selection,
          technical review and documentation follow-up central parts of our quality approach.
        </p>
        <p>
          Our quality support is designed to reduce sourcing risk, improve traceability and help customers receive
          components that are aligned with drawings, material requirements, inspection expectations and final
          application needs.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="EDS quality assurance highlights">
        <article>
          <h3>Supplier Qualification</h3>
          <p>Production partners are selected according to process capability, material experience and quality expectations.</p>
        </article>

        <article>
          <h3>Inspection Follow-Up</h3>
          <p>Dimensional reports, visual checks and testing requirements are coordinated according to project scope.</p>
        </article>

        <article>
          <h3>Documentation Control</h3>
          <p>Certificates, measurement records and traceability documents are followed up before delivery whenever required.</p>
        </article>
      </div>
    </section>

    <section class="eds-commercial-section eds-commercial-section--soft" id="supplier-risk-reduction" aria-labelledby="risk-reduction-title">
      <div class="eds-commercial-header">
        <p class="eds-commercial-eyebrow">Supplier Risk Reduction</p>
        <h2 id="risk-reduction-title">Quality control as supplier risk reduction</h2>
        <p>
          For EDS, quality is not only a final inspection step. It is part of the sourcing process from the beginning.
          By reviewing drawings, specifications, supplier capabilities and documentation requirements early, we help reduce
          the risk of non-conformities, delays and unclear responsibilities during production.
        </p>
        <p>
          This approach is especially important when components are produced through external manufacturing partners and
          customers need visibility over material, dimensions, inspection records or surface treatment documentation.
        </p>
      </div>

      <ul class="eds-challenge-list">
        <li><strong>Drawing and specification review</strong><p>EDS reviews drawings, material specifications, tolerances, surface treatment requirements and documentation expectations before and during supplier coordination.</p></li>
        <li><strong>Material and certificate follow-up</strong><p>Depending on the project, EDS can coordinate material certificates and related documentation so customers have better visibility over the technical basis of the supplied components.</p></li>
        <li><strong>Dimensional and inspection documentation</strong><p>For industrial components, dimensional reports and inspection records can be essential. EDS can support the follow-up of these documents according to project requirements.</p></li>
        <li><strong>Surface treatment and coating documentation</strong><p>When surface finishing or coating is part of the supply route, EDS can help coordinate the related documentation and supplier communication.</p></li>
        <li><strong>Supplier communication and corrective actions</strong><p>When questions or non-conformities arise, EDS supports communication between customer and supplier so technical feedback is clear.</p></li>
        <li><strong>Production and delivery follow-up</strong><p>EDS helps coordinate follow-up so technical and logistical expectations remain aligned before delivery.</p></li>
      </ul>
    </section>

    <!-- QUALITY PHILOSOPHY -->
    <section class="process-section process-split" aria-labelledby="quality-philosophy-title">
      <div>
        <p class="process-eyebrow">Quality Philosophy</p>
        <h2 id="quality-philosophy-title">A practical quality approach for international industrial sourcing</h2>
        <p>
          EDS works with casting, forging, machining and finishing suppliers across international production networks.
          Because every project has different requirements, our quality approach is based on defining the correct
          control points before production starts.
        </p>
        <p>
          This includes understanding the drawing, identifying critical features, clarifying material standards,
          defining inspection expectations, reviewing supplier capability and making sure the documentation package
          matches the customer’s internal quality requirements.
        </p>
      </div>

      <aside class="process-callout process-callout--neutral" aria-label="Quality control focus areas">
        <h3>Quality control focus</h3>
        <ul>
          <li>Technical drawing and specification review</li>
          <li>Supplier capability and process fit</li>
          <li>Material certificates and traceability</li>
          <li>Dimensional and visual inspection follow-up</li>
          <li>Corrective action support when needed</li>
        </ul>
      </aside>
    </section>

    <!-- SUPPLIER QUALIFICATION -->
    <section class="process-section" id="supplier-qualification" aria-labelledby="supplier-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Supplier Qualification</p>
        <h2 id="supplier-title">Matching each project with the right production partner</h2>
        <p>
          A reliable supply route depends on selecting suppliers that understand the material, process, tolerances,
          documentation and production volume required by the project. EDS evaluates supplier fit before and during
          production to reduce avoidable quality and delivery risks.
        </p>
      </div>

      <div class="process-grid-3 quality-card-grid">
        <article class="process-card">
          <h3>Process capability</h3>
          <p>
            Supplier selection considers whether the production partner is suitable for the required casting,
            forging, machining, finishing or assembly route.
          </p>
        </article>

        <article class="process-card">
          <h3>Material expertise</h3>
          <p>
            Experience with steel, cast iron, stainless steel, aluminium, bronze or special alloys is reviewed
            according to the customer specification.
          </p>
        </article>

        <article class="process-card">
          <h3>Quality system maturity</h3>
          <p>
            EDS works with suppliers operating under structured quality systems and aligns supplier documentation
            expectations with the requirements of each project.
          </p>
        </article>
      </div>
    </section>

    <section class="eds-commercial-section eds-commercial-section--soft" id="quality-faq" aria-labelledby="quality-faq-title">
      <div class="eds-commercial-header">
        <p class="eds-commercial-eyebrow">Quality FAQ</p>
        <h2 id="quality-faq-title">Quality and supplier control FAQ</h2>
        <p>
          These answers clarify how EDS coordinates supplier quality control as an engineering-driven sourcing partner,
          not as an in-house manufacturer.
        </p>
      </div>

      <div class="eds-faq">
        <?php foreach ($qualityFaqs as $faq): ?>
          <details>
            <summary><?= htmlspecialchars($faq['question'], ENT_QUOTES, 'UTF-8') ?></summary>
            <p><?= htmlspecialchars($faq['answer'], ENT_QUOTES, 'UTF-8') ?></p>
          </details>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- INSPECTION -->
    <section class="process-section process-section--soft" id="inspection" aria-labelledby="inspection-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Inspection & Testing</p>
        <h2 id="inspection-title">Inspection requirements defined according to component function</h2>
        <p>
          Not every component requires the same quality control plan. EDS helps coordinate the inspection level
          according to the part’s function, drawing requirements, material risk, application environment and customer
          documentation expectations.
        </p>
      </div>

      <div class="quality-inspection-grid">
        <article>
          <h3>Dimensional inspection</h3>
          <p>
            Measurement reports, critical dimensions, machining references, CMM checks or supplier inspection records
            can be coordinated depending on the drawing and project scope.
          </p>
        </article>

        <article>
          <h3>Visual inspection</h3>
          <p>
            Surface condition, casting defects, forging marks, coating quality, packing condition and visual criteria
            can be checked before shipment when required.
          </p>
        </article>

        <article>
          <h3>Material and mechanical testing</h3>
          <p>
            Chemical composition, hardness, tensile properties, impact testing or other mechanical tests can be
            arranged when specified by the customer or standard.
          </p>
        </article>

        <article>
          <h3>Non-destructive testing</h3>
          <p>
            NDT methods such as ultrasonic testing, magnetic particle testing, dye penetrant inspection or radiography
            can be coordinated when needed for critical applications.
          </p>
        </article>
      </div>
    </section>

    <!-- DOCUMENTATION -->
    <section class="process-section" id="quality-documentation" aria-labelledby="documentation-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Documentation & Traceability</p>
        <h2 id="documentation-title">Quality documents coordinated before delivery</h2>
        <p>
          Documentation requirements should be defined before production begins. Depending on the project requirements,
          EDS can help coordinate material certificates, dimensional reports, inspection records, coating documentation
          and other customer-specific quality documents.
        </p>
      </div>

      <table class="process-spec-table quality-spec-table" aria-label="Quality documentation support provided by EDS">
        <tbody>
          <tr>
            <th scope="row">Material certificates</th>
            <td>EN 10204 3.1, EN 10204 2.2 or supplier-specific material documentation depending on project requirements.</td>
          </tr>
          <tr>
            <th scope="row">Dimensional reports</th>
            <td>Measurement reports, control sheets, CMM records or critical dimension checks based on the technical drawing.</td>
          </tr>
          <tr>
            <th scope="row">Testing records</th>
            <td>Chemical analysis, hardness reports, tensile testing, impact testing or NDT reports when required.</td>
          </tr>
          <tr>
            <th scope="row">Surface and finishing records</th>
            <td>Coating reports, surface treatment certificates, thickness records, visual checks or corrosion protection documentation.</td>
          </tr>
          <tr>
            <th scope="row">Identification and traceability</th>
            <td>Batch references, part identification, packing labels, photo records and project-specific traceability requirements.</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- NON-CONFORMITY -->
    <section class="process-section process-split" id="non-conformity" aria-labelledby="nonconformity-title">
      <div>
        <p class="process-eyebrow">Non-Conformity Handling</p>
        <h2 id="nonconformity-title">Structured follow-up when deviations or quality issues occur</h2>
        <p>
          If a deviation, defect or documentation issue is reported, EDS supports communication between the customer
          and supplier to clarify the facts, review evidence and agree on the appropriate next step. Depending on
          the situation, this may involve rework, replacement, credit, additional inspection or corrective action.
        </p>
        <p>
          Our objective is to resolve issues transparently and prevent recurrence by identifying the root cause,
          improving communication and adjusting inspection or process controls where needed.
        </p>
      </div>

      <aside class="quality-flow-card" aria-label="Non-conformity handling flow">
        <h3>Typical issue flow</h3>
        <ol>
          <li>Customer reports issue with evidence</li>
          <li>EDS reviews scope, batch and documentation</li>
          <li>Supplier feedback and root cause are requested</li>
          <li>Corrective action or resolution is agreed</li>
          <li>Preventive measures are followed up when needed</li>
        </ol>
      </aside>
    </section>

    <!-- RESPONSIBILITY -->
    <section class="process-section process-section--soft" aria-labelledby="responsibility-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Commercial Responsibility</p>
        <h2 id="responsibility-title">A clear coordination role between customer requirements and supplier execution</h2>
        <p>
          Although EDS does not manufacture components in-house, we take our coordination role seriously. We support
          customers by aligning technical requirements, supplier capability, quality documentation and delivery follow-up.
          Warranty and responsibility terms are project-specific and should always be reviewed together with the
          applicable quotation, order confirmation and EDS General Terms &amp; Conditions.
        </p>
      </div>

      <div class="process-grid-3 quality-card-grid">
        <article class="process-card">
          <h3>Before production</h3>
          <p>
            Drawings, specifications, tolerances, material standards and documentation expectations are clarified.
          </p>
        </article>

        <article class="process-card">
          <h3>During production</h3>
          <p>
            Supplier communication, inspection planning and project-specific requirements are followed up.
          </p>
        </article>

        <article class="process-card">
          <h3>Before shipment</h3>
          <p>
            Documents, packing, identification and delivery readiness are checked according to the agreed scope.
          </p>
        </article>
      </div>
    </section>

    <!-- RELATED -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Related EDS Support</p>
        <h2 id="related-title">Explore services connected to quality control</h2>
        <p>
          Quality assurance is connected to process selection, supplier coordination, machining requirements,
          surface finishing and logistics planning.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/casting-matrix">
          <h3>Casting Matrix</h3>
          <p>Compare casting routes and understand how process selection affects quality, tolerances and documentation.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/supply-chain">
          <h3>Supply Chain Support</h3>
          <p>Coordinate suppliers, production follow-up, delivery planning and project documentation.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/workflow">
          <h3>EDS Workflow</h3>
          <p>See how EDS manages projects from technical review to supplier follow-up and delivery.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="process-section process-final-cta" aria-labelledby="quality-cta-title">
      <div>
        <p class="process-eyebrow">Define Your Quality Requirements</p>
        <h2 id="quality-cta-title">Need specific inspection reports, certificates or traceability for your components?</h2>
        <p>
          Send us your drawing, material specification and quality requirements. EDS can help review the required
          documentation package, supplier capability and inspection approach for your project.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/contact">Discuss Quality Requirements</a>
        <a class="process-btn process-btn--secondary" href="/terms">View Terms &amp; Conditions</a>
      </div>
    </section>

  </div>
</main>

<script type="application/ld+json">
<?= json_encode($qualitySchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
<script type="application/ld+json">
<?= json_encode($qualityFaqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
