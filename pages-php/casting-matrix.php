<?php require_once __DIR__ . '/../includes/seo.php'; ?>
<?php include __DIR__ . '/../includes/head.php'; ?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="process-page process-page--casting-matrix">

  <!-- HERO -->
  <section
    class="process-hero"
    aria-labelledby="process-hero-title"
    style="background-image: url('/assets/img/hero/casting-matrix-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="process-hero-title">Casting Process Selection for Industrial Metal Components</h1>

      <p class="process-hero__summary">
        EDS helps industrial buyers compare casting routes by reviewing geometry, alloy, production volume,
        tooling cost, tolerances, surface finish, machining needs and supplier capability before production starts.
      </p>

      <div class="process-hero__actions" aria-label="Casting matrix page actions">
        <a class="process-btn process-btn--primary" href="/contact">Request Casting Support</a>
        <a class="process-btn process-btn--secondary" href="#matrix-table">View Technical Matrix</a>
      </div>
    </div>
  </section>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="Casting matrix page navigation">
    <a href="#overview">Overview</a>
    <a href="#selection">Selection</a>
    <a href="#matrix-table">Matrix</a>
    <a href="#chart">Chart</a>
    <a href="#quality">Quality</a>
    <a href="#related">Related</a>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="overview" aria-labelledby="overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">Casting Matrix</p>
        <h2 id="overview-title">A practical decision tool for selecting the right casting process</h2>
        <p>
          Selecting a casting process is not only a matter of price. The correct route depends on the component
          geometry, required alloy, wall thickness, expected tolerances, surface finish, machining allowance,
          tooling strategy, production volume and quality documentation requirements.
        </p>
        <p>
          The EDS Casting Matrix gives engineers and buyers a structured way to compare the most relevant casting
          processes before committing to tooling, supplier selection or production. It helps identify which route
          is technically realistic and commercially sensible for a specific industrial component.
        </p>
        <p>
          EDS operates as an engineering and trading partner. We do not operate our own foundry; instead, we support
          process selection, supplier alignment, technical follow-up, documentation control and logistics coordination
          through qualified external production partners.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="Casting matrix key benefits">
        <article>
          <h3>Process Fit</h3>
          <p>Compare casting routes based on geometry, alloy, tolerances, surface finish and production volume.</p>
        </article>

        <article>
          <h3>Total Cost View</h3>
          <p>Balance tooling cost, machining needs, quality requirements and long-term production efficiency.</p>
        </article>

        <article>
          <h3>Supplier Alignment</h3>
          <p>Connect the component requirements with suppliers capable of meeting technical and delivery expectations.</p>
        </article>
      </div>
    </section>

    <!-- SELECTION LOGIC -->
    <section class="process-section" id="selection" aria-labelledby="selection-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Process Selection</p>
        <h2 id="selection-title">How EDS evaluates casting feasibility before sourcing</h2>
        <p>
          Each casting process has different strengths and limitations. EDS reviews the complete project context
          so that the selected route fits the component function, manufacturing constraints and commercial objectives.
        </p>
      </div>

      <div class="process-grid-3">
        <article class="process-card">
          <h3>Geometry and wall thickness</h3>
          <p>
            Complex shapes, ribs, bosses, internal cavities, draft angles, minimum wall thickness and machining
            allowance influence whether sand casting, investment casting, die casting or another route is suitable.
          </p>
        </article>

        <article class="process-card">
          <h3>Material and performance</h3>
          <p>
            Cast iron, steel, stainless steel, aluminium, bronze and powder metal routes each require different
            process assumptions, supplier experience and quality controls.
          </p>
        </article>

        <article class="process-card">
          <h3>Volume and tooling strategy</h3>
          <p>
            Prototype, low-volume and high-volume programs have different tooling economics. The best process must
            balance upfront tooling cost with repeatability and unit cost.
          </p>
        </article>
      </div>
    </section>

    <!-- MATRIX TABLE -->
    <section class="process-section matrix-table-section" id="matrix-table" aria-labelledby="matrix-table-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Technical Matrix</p>
        <h2 id="matrix-table-title">Side-by-side comparison of casting processes</h2>
        <p>
          The values below are intended as a practical engineering guide. Final feasibility must always be checked
          against the drawing, alloy, tolerances, inspection requirements, production quantity and supplier capability.
        </p>
      </div>

      <div class="matrix-table-container" role="region" aria-label="Scrollable casting process comparison table" tabindex="0">
        <table class="casting-matrix-table">
          <thead>
            <tr>
              <th scope="col">Property</th>
              <th scope="col">Sand Casting</th>
              <th scope="col">Investment Casting<br><span>Water Glass</span></th>
              <th scope="col">Investment Casting<br><span>Silica Sol</span></th>
              <th scope="col">Shell Moulding</th>
              <th scope="col">Gravity Die Casting</th>
              <th scope="col">High-Pressure Die Casting</th>
              <th scope="col">Lost Foam Casting</th>
              <th scope="col">Sintering</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Metals</th>
              <td>Ferrous &amp; non-ferrous</td>
              <td>Most ferrous alloys</td>
              <td>Most ferrous alloys</td>
              <td>Most ferrous alloys</td>
              <td>Non-ferrous alloys</td>
              <td>Non-ferrous alloys</td>
              <td>Most ferrous alloys</td>
              <td>Ferrous &amp; non-ferrous powders</td>
            </tr>
            <tr>
              <th scope="row">Component size</th>
              <td>Small to very large</td>
              <td>Small to medium</td>
              <td>Small to medium</td>
              <td>Small to medium</td>
              <td>Small to large</td>
              <td>Small to medium</td>
              <td>Medium</td>
              <td>Very small to small</td>
            </tr>
            <tr>
              <th scope="row">Typical weight range</th>
              <td>0.01 kg to many tonnes</td>
              <td>0.01–20 kg, max. around 50 kg</td>
              <td>0.01–10 kg, max. around 50 kg</td>
              <td>0.01–10+ kg</td>
              <td>0.01–75 kg, max. around 300 kg</td>
              <td>0.01–10 kg, max. around 40 kg</td>
              <td>1–200 kg</td>
              <td>0.05–1 kg</td>
            </tr>
            <tr>
              <th scope="row">Design flexibility</th>
              <td>High</td>
              <td>Very high</td>
              <td>High</td>
              <td>High</td>
              <td>Moderate</td>
              <td>Relatively high</td>
              <td>High</td>
              <td>Moderate</td>
            </tr>
            <tr>
              <th scope="row">Typical production volume</th>
              <td>1–1,000 pcs</td>
              <td>10–500 pcs</td>
              <td>10–500 pcs</td>
              <td>100+ pcs</td>
              <td>1,000+ pcs</td>
              <td>10,000+ pcs</td>
              <td>500–1,000 pcs</td>
              <td>10,000+ pcs</td>
            </tr>
            <tr>
              <th scope="row">Tooling cost</th>
              <td>$</td>
              <td>$</td>
              <td>$</td>
              <td>$$</td>
              <td>$$</td>
              <td>$$$</td>
              <td>$$$</td>
              <td>$$$$</td>
            </tr>
            <tr>
              <th scope="row">Secondary machining need</th>
              <td>High</td>
              <td>Moderate</td>
              <td>Low</td>
              <td>Low</td>
              <td>Moderate</td>
              <td>Very low</td>
              <td>Low</td>
              <td>None to low</td>
            </tr>
            <tr>
              <th scope="row">Manufacturing cost</th>
              <td>Low</td>
              <td>Low</td>
              <td>Medium</td>
              <td>Medium</td>
              <td>Low</td>
              <td>Medium</td>
              <td>Medium to high</td>
              <td>High</td>
            </tr>
            <tr>
              <th scope="row">Dimensional tolerance</th>
              <td>ISO 8062 CT10–CT12</td>
              <td>ISO 8062 CT7–CT9</td>
              <td>ISO 8062 CT4–CT6</td>
              <td>ISO 8062 CT7–CT8</td>
              <td>ISO 8062 CT7–CT8</td>
              <td>ISO 8062 CT4–CT5</td>
              <td>ISO 8062 CT7–CT8</td>
              <td>ISO 8062 CT1–CT2</td>
            </tr>
            <tr>
              <th scope="row">Minimum wall thickness</th>
              <td>6–8 mm</td>
              <td>4–5 mm</td>
              <td>2 mm</td>
              <td>5 mm</td>
              <td>4 mm</td>
              <td>2.5 mm</td>
              <td>3 mm</td>
              <td>3–4 mm</td>
            </tr>
            <tr>
              <th scope="row">Draft angle</th>
              <td>±2.0°</td>
              <td>±1.0°</td>
              <td>±0.5°</td>
              <td>±1.0°</td>
              <td>±0.5°</td>
              <td>±1.5°</td>
              <td>Reduced parting limitation</td>
              <td>±0.1°</td>
            </tr>
            <tr>
              <th scope="row">Surface finish</th>
              <td>Ra 50 µm</td>
              <td>Ra 25 µm</td>
              <td>Ra 3.2 µm</td>
              <td>Ra 25 µm</td>
              <td>Ra 12.5 µm</td>
              <td>Ra 3.2 µm</td>
              <td>Ra 25 µm</td>
              <td>Ra 3.2 µm</td>
            </tr>
          </tbody>
        </table>
      </div>

      <p class="matrix-note">
        <strong>Important:</strong> Values are indicative and based on practical engineering ranges. Exact limits depend on supplier capability,
        alloy selection, component design, quality level and final application requirements.
      </p>
    </section>

    <!-- CHART -->
    <section class="process-section matrix-graph" id="chart" aria-labelledby="chart-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Visual Comparison</p>
        <h2 id="chart-title">Normalized comparison of casting process capabilities</h2>
        <p>
          The chart provides a quick visual comparison of process characteristics. It should be used as a decision
          support tool, not as a replacement for a technical drawing review.
        </p>
      </div>

      <div class="matrix-chart-card">
        <canvas id="castingChart" aria-label="Normalized casting process comparison chart" role="img"></canvas>
      </div>

      <p class="graph-note">
        Scale: 1 = limited capability or higher constraint, 5 = strong capability or favorable condition. Cost-related values are normalized for comparison.
      </p>
    </section>

    <!-- QUALITY -->
    <section class="process-section process-section--soft" id="quality" aria-labelledby="quality-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Quality & Documentation</p>
        <h2 id="quality-title">Casting process selection must include quality control from the beginning</h2>
        <p>
          A casting route is only reliable when the supplier, inspection plan and documentation package match the
          customer’s requirements. EDS helps connect process selection with quality follow-up and supplier communication.
        </p>
      </div>

      <div class="process-grid-3">
        <article class="process-card">
          <h3>Supplier capability review</h3>
          <p>
            We align the casting route with suppliers capable of meeting material, geometry, quality and delivery expectations.
          </p>
        </article>

        <article class="process-card">
          <h3>Inspection planning</h3>
          <p>
            We coordinate dimensional checks, material certificates, chemical analysis, testing and reporting requirements.
          </p>
        </article>

        <article class="process-card">
          <h3>Production follow-up</h3>
          <p>
            We support communication during tooling, sampling, casting, machining, finishing, inspection and delivery.
          </p>
        </article>
      </div>
    </section>

    <!-- RELATED -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Related Casting Pages</p>
        <h2 id="related-title">Explore specific casting processes in more detail</h2>
        <p>
          Use the pages below to review the technical characteristics, applications and process-specific decision
          factors for each casting route.
        </p>
      </div>

      <div class="process-related-grid matrix-related-grid--wide">
        <a class="process-related-card" href="/sand-casting">
          <h3>Sand Casting</h3>
          <p>Flexible route for large components, internal cavities, complex shapes and low to medium production volumes.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/investment">
          <h3>Investment Casting</h3>
          <p>Precision casting for fine detail, tighter tolerances, near-net shapes and reduced machining needs.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/shell-moulding">
          <h3>Shell Moulding</h3>
          <p>Improved repeatability and surface finish for technical castings and medium-volume production.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/gravity-die">
          <h3>Gravity Die Casting</h3>
          <p>Permanent mould casting for repeatable non-ferrous components and stable production quality.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/high-pressure-die">
          <h3>High-Pressure Die Casting</h3>
          <p>High-volume non-ferrous casting for thin-wall capability, fast cycles and repeatable output.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/lost-foam">
          <h3>Lost Foam Casting</h3>
          <p>Integrated geometry and reduced parting line limitations using expendable foam patterns.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="process-section process-final-cta" aria-labelledby="casting-matrix-cta-title">
      <div>
        <p class="process-eyebrow">Start a Casting Project</p>
        <h2 id="casting-matrix-cta-title">Need help choosing the right casting process for your component?</h2>
        <p>
          Send us your drawing, material specification, expected quantity or application requirements. EDS can help
          compare process options, review supplier feasibility and coordinate the next steps.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/contact">Request Casting Support</a>
        <a class="process-btn process-btn--secondary" href="/machining">Explore Machining Support</a>
      </div>
    </section>

  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script defer src="/assets/js/casting-matrix.js"></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
