<?php
require_once __DIR__ . '/../includes/seo.php';

/* Industries & Partners uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;

$industriesServiceSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'Service',
  'name' => 'Industrial OEM Component Sourcing and Supplier Coordination',
  'provider' => [
    '@type' => 'Organization',
    'name' => 'EDS Casting & Forging B.V.',
    'url' => 'https://www.edscasting.com',
  ],
  'serviceType' => 'Engineering-driven sourcing for industrial OEM cast and forged components',
  'areaServed' => 'Europe',
  'description' => 'EDS supports railway, machinery, automotive, energy, heavy industry and industrial OEM customers with supplier selection, production coordination, quality documentation and supply chain communication.',
];

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page ind-part-page">

  <!-- HERO -->
  <section
    class="process-hero ind-part-hero"
    aria-labelledby="ind-part-hero-title"
    style="background-image: url('/assets/img/hero/industries-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="ind-part-hero-title">Industries &amp; Partners for Engineering-Driven Metal Components</h1>

      <p class="process-hero__summary">
        EDS supports industrial customers across railway, transport, hydraulics, energy, heavy equipment and machinery
        sectors with casting, forging, machining, quality documentation and global supplier coordination.
      </p>

      <div class="process-hero__actions" aria-label="Industries and partners page actions">
        <a class="process-btn process-btn--primary" href="/contact#sourcing-challenge" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="industries_hero_discuss_requirement" data-eds-category="industries_hero">Discuss Your Industry Requirement</a>
        <a class="process-btn process-btn--secondary" href="/projects#project-cases" data-eds-track data-eds-event="internal_strategy_link_click" data-eds-label="industries_hero_project_applications" data-eds-category="industries_hero">View Project Applications</a>
      </div>
    </div>
  </section>

  <?php
    $edsBreadcrumbItems = [
      ['label' => 'Home', 'url' => '/'],
      ['label' => 'Industries & Partners', 'url' => '/industries-partners'],
    ];
    include __DIR__ . '/../includes/breadcrumbs.php';
  ?>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="Industries and partners page navigation">
    <a href="#overview">Overview</a>
    <a href="#industries-we-support">Industries</a>
    <a href="#applications">Applications</a>
    <a href="#partners">Partners</a>
    <a href="#partnership-model">Control</a>
    <a href="#related">Related</a>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="overview" aria-labelledby="overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">Industries &amp; Partners</p>
        <h2 id="overview-title">Industries where technical sourcing matters</h2>
        <p>
          EDS connects customer requirements with suitable manufacturing partners for cast, forged, machined and finished
          metal components. We support industries where durability, tolerances, documentation and reliable supply must be
          coordinated from the first technical review through delivery.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="EDS industry support highlights">
        <article>
          <h3>Application-Driven Engineering</h3>
          <p>Component requirements are reviewed according to industry use, material behavior and manufacturing feasibility.</p>
        </article>

        <article>
          <h3>Qualified Supplier Network</h3>
          <p>EDS coordinates production through external partners selected for process capability and quality expectations.</p>
        </article>

        <article>
          <h3>Reliable Supply Coordination</h3>
          <p>Production follow-up, documentation and logistics are coordinated to support predictable industrial delivery.</p>
        </article>
      </div>
    </section>

    <!-- INDUSTRIES GRID -->
    <section class="process-section ind-part-industries" id="industries-we-support" aria-labelledby="industries-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Industries We Support</p>
        <h2 id="industries-title">Industrial sectors where component performance and supply reliability matter</h2>
        <p>
          EDS supports customers in sectors where metal components must perform under mechanical load,
          environmental exposure, dimensional requirements and recurring supply expectations. The examples below
          show the main areas where our engineering and sourcing support can create value.
        </p>
      </div>

      <div class="ind-part-industry-grid" aria-label="Main industries served by EDS">
        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/railway.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Railway</h3>
          <p>Durable cast, forged and machined components requiring repeatability, documentation and long-term supply reliability.</p>
          <a href="/projects?field=railway#project-cases">View railway projects</a>
        </article>

        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/industrial.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Industrial Equipment</h3>
          <p>Structural, machined and process-critical components for machinery, production systems and industrial installations.</p>
          <a href="/projects?field=industrial-machinery#project-cases">View industrial projects</a>
        </article>

        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/construction.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Construction &amp; Infrastructure</h3>
          <p>Robust components for demanding environments where strength, coating, wear behavior and availability are important.</p>
          <a href="/projects?field=construction-equipment#project-cases">View construction projects</a>
        </article>

        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/energy.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Energy</h3>
          <p>Manufacturing support for components where material integrity, documentation and controlled production are essential.</p>
          <a href="/projects?field=energy-infrastructure#project-cases">View energy projects</a>
        </article>

        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/agriculture.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Agriculture</h3>
          <p>Wear-resistant and mechanically loaded components for agricultural machines and equipment operating in harsh conditions.</p>
          <a href="/projects?field=agricultural-machinery#project-cases">View agriculture projects</a>
        </article>

        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/demolition.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Demolition &amp; Heavy Equipment</h3>
          <p>High-strength and wear-focused components for excavating, demolition, lifting and heavy-duty operational environments.</p>
          <a href="/projects?field=construction-equipment#project-cases">View heavy equipment projects</a>
        </article>

        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/marine.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Marine &amp; Offshore</h3>
          <p>Components requiring corrosion protection, material selection, surface finishing and documentation control.</p>
          <a href="/projects?field=energy-infrastructure#project-cases">View offshore projects</a>
        </article>

        <article class="ind-part-industry-card">
          <img src="/assets/img/icons/automotive.webp" alt="" width="113" height="160" loading="lazy" decoding="async">
          <h3>Transport &amp; Mobility</h3>
          <p>Repeatable metal components where weight, strength, dimensional control and production stability are key factors.</p>
          <a href="/projects?field=automotive-mobility#project-cases">View transport projects</a>
        </article>
      </div>
    </section>

    <!-- APPLICATION AREAS -->
    <section class="process-section ind-part-application-section" id="applications" aria-labelledby="applications-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Application Areas</p>
        <h2 id="applications-title">How we translate application demands into a sourcing route</h2>
        <p>
          Instead of repeating industries, this section shows how EDS reads the function of a component and turns it into
          practical decisions about process, supplier fit, inspection and delivery control.
        </p>
      </div>

      <div class="process-grid-3 ind-part-application-grid">
        <article class="process-card">
          <h3>Function and Load Profile</h3>
          <p>
            We review how the part is used: load direction, wear, sealing, assembly, safety relevance and environmental
            exposure.
          </p>
          <a href="/projects#case-structure">Explore project structure</a>
        </article>

        <article class="process-card">
          <h3>Manufacturing Route Selection</h3>
          <p>
            Casting, forging, machining, coating and assembly are compared against geometry, material behavior, tolerance
            and volume needs.
          </p>
          <a href="/casting-matrix">Explore process comparison</a>
        </article>

        <article class="process-card">
          <h3>Supply and Quality Control</h3>
          <p>
            Supplier communication, inspection expectations, certificates, packing and logistics are aligned before
            production becomes a delivery risk.
          </p>
          <a href="/quality">Explore quality support</a>
        </article>
      </div>
    </section>

    <!-- PARTNER NETWORK -->
    <section class="process-section process-split" id="partners" aria-labelledby="partners-title">
      <div>
        <p class="process-eyebrow">Partner Network</p>
        <h2 id="partners-title">A coordinated network of production, finishing and logistics partners</h2>
        <p>
          EDS works with a network of external manufacturing partners, including foundries, forging suppliers,
          machining companies, finishing providers and logistics partners. This allows us to support different
          component types without being limited to one production method or one internal facility.
        </p>
        <p>
          Supplier selection is based on process capability, material experience, documentation expectations,
          production volume, lead time, communication reliability and the specific requirements of the customer’s project.
        </p>
      </div>

      <aside class="process-callout process-callout--neutral" aria-label="EDS partner network focus areas">
        <h3>Partner network focus</h3>
        <ul>
          <li>Foundries for cast iron, steel and selected non-ferrous alloys</li>
          <li>Forging suppliers for high-strength industrial components</li>
          <li>Machining and finishing partners for ready-to-use parts</li>
          <li>Quality documentation and inspection coordination</li>
          <li>Logistics support for international supply programs</li>
        </ul>
      </aside>
    </section>

    <section class="eds-commercial-section" id="partnership-model" aria-labelledby="partnership-model-title">
      <div class="eds-commercial-header">
        <p class="eds-commercial-eyebrow">Partnership &amp; Quality Control</p>
        <h2 id="partnership-model-title">How EDS coordinates partners, quality and delivery</h2>
        <p>
          EDS acts as a technical and commercial bridge between industrial customers and selected manufacturing partners.
          We help customers work with external production partners while keeping better control over technical requirements,
          supplier communication, documentation, inspection follow-up and delivery continuity.
        </p>
      </div>
      <table class="eds-partnership-table" aria-label="EDS partnership, quality and delivery coordination factors">
        <tbody>
          <tr>
            <th scope="row">Technical clarity</th>
            <td>Requirements are reviewed before sourcing decisions are made.</td>
          </tr>
          <tr>
            <th scope="row">Supplier communication</th>
            <td>Manufacturing partners are aligned with customer expectations and project context.</td>
          </tr>
          <tr>
            <th scope="row">Quality documentation</th>
            <td>Certificates, inspection records and project documents are followed up before delivery.</td>
          </tr>
          <tr>
            <th scope="row">Supply continuity</th>
            <td>Availability and repeat supply are considered beyond the first order.</td>
          </tr>
          <tr>
            <th scope="row">Technical sourcing fit</th>
            <td>Sourcing decisions are based on process capability, material fit and quality needs, not only price.</td>
          </tr>
          <tr>
            <th scope="row">Single point of contact</th>
            <td>EDS coordinates communication across suppliers, quality follow-up and logistics.</td>
          </tr>
          <tr>
            <th scope="row">Technical review</th>
            <td>Drawings, materials, application conditions, tolerances, machining needs and finishing requirements are evaluated.</td>
          </tr>
          <tr>
            <th scope="row">Supplier fit</th>
            <td>Partners are selected according to process capability, material experience, quality expectations and production volume.</td>
          </tr>
          <tr>
            <th scope="row">Inspection records</th>
            <td>Material certificates, dimensional reports, inspection records, coating documents and project-specific files are coordinated.</td>
          </tr>
          <tr>
            <th scope="row">Delivery coordination</th>
            <td>Packing, shipping, logistics planning, stock support and customer communication are followed up through delivery.</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- RELATED -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Related EDS Support</p>
        <h2 id="related-title">Explore processes and services connected to your industry</h2>
        <p>
          Industry requirements usually define the manufacturing route. Use the links below to explore the main
          EDS support areas connected to industrial component sourcing.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/casting-matrix">
          <h3>Casting Matrix</h3>
          <p>Compare casting processes according to geometry, material, volume, tolerance and tooling strategy.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/forging">
          <h3>Forging Solutions</h3>
          <p>Explore forged component support for applications requiring strength and mechanical reliability.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/supply-chain">
          <h3>Supply Chain Support</h3>
          <p>Coordinate suppliers, production status, quality documentation, logistics and delivery planning.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="process-section process-final-cta" aria-labelledby="ind-part-cta-title">
      <div>
        <p class="process-eyebrow">Start an Industry-Specific Project</p>
        <h2 id="ind-part-cta-title">Need a partner that understands industrial metal component requirements?</h2>
        <p>
          Send us your drawing, application details, material specification or current sourcing challenge.
          EDS can help evaluate the manufacturing route, supplier fit, quality requirements and supply chain strategy.
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
<?= json_encode($industriesServiceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
