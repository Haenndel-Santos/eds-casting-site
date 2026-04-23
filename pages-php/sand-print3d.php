<?php require_once __DIR__ . '/../includes/seo.php';?>
<?php include '../includes/head.php'; ?> 
<?php include '../includes/header.php'; ?>

<main class="mainpage-content">

  <!-- HERO SECTION -->
  <section class="mainpage-hero hero-fullimage"
           style="background-image: url('/assets/img/hero/3dsand.webp');">
    <div class="hero-overlay"></div>
    <div class="hero-text">
      <h1>3D Sand Printing</h1>
      <p>Digital manufacturing of complex sand molds and cores for high-precision casting applications.</p>
    </div>
  </section>

  <!-- OVERVIEW -->
  <section class="mainpage-section mainpage-overview">
    <h2>Overview</h2>
    <p>
      3D Sand Printing is an additive manufacturing process that builds sand molds and cores directly from CAD data 
      without the need for traditional tooling. Using a binder jetting system, thin layers of sand are selectively 
      bonded by a resin-based adhesive to create detailed, dimensionally accurate casting molds.
    </p>
    <p>
      This innovative process drastically reduces lead times, enables rapid prototyping, and allows geometries that 
      would be impossible with conventional molding methods. It is ideal for low to medium-volume production, 
      design validation, and customized engineering solutions.
    </p>
  </section>

  <!-- PROCESS CHARACTERISTICS -->
  <section class="mainpage-section alt">
    <h2>Process Characteristics</h2>
    <ul class="mainpage-list">
      <li><strong>Printing technology:</strong> Binder jetting with layer-by-layer sand and resin bonding.</li>
      <li><strong>Materials:</strong> Silica, chromite, or ceramic sands with furan, phenolic, or inorganic binders.</li>
      <li><strong>Dimensional accuracy:</strong> ±0.3 mm for most geometries depending on size and binder system.</li>
      <li><strong>Build volume:</strong> Up to several cubic meters depending on printer configuration.</li>
      <li><strong>Surface finish:</strong> Ra 6.3–12.5 μm; directly usable for casting applications.</li>
      <li><strong>Tooling:</strong> No physical pattern required — design changes can be implemented instantly.</li>
      <li><strong>Production flexibility:</strong> Suitable for prototypes, pre-series, and complex small-batch production.</li>
    </ul>
  </section>

  <!-- MAIN APPLICATIONS -->
  <section class="mainpage-section">
    <h2>Main Applications</h2>
    <p>
      3D Sand Printing is transforming the foundry industry by offering unmatched design freedom and agility.
      It is commonly used in:
    </p>
    <ul class="mainpage-list">
      <li>Rapid prototyping and pre-series casting for R&D and product validation</li>
      <li>Complex core geometries and integrated mold assemblies</li>
      <li>Custom or low-volume industrial components</li>
      <li>Lightweight or topology-optimized parts for performance engineering</li>
      <li>Tooling-free production for small or customized cast series</li>
    </ul>
  </section>

  <!-- KEY ADVANTAGES -->
  <section class="mainpage-section alt">
    <h2>Key Advantages</h2>
    <ul class="mainpage-list">
      <li>Elimination of traditional tooling and pattern making</li>
      <li>Fast design-to-production cycle for prototypes and iterations</li>
      <li>Freedom to produce complex geometries with internal channels</li>
      <li>Reduced material waste and setup time</li>
      <li>Improved casting precision and process repeatability</li>
    </ul>
  </section>

<!-- INTERNAL LINKING SECTION -->
<section class="mainpage-section mainpage-related">
  <h2>Related Processes and Services</h2>

  <div class="related-grid">

    <a class="mainpage-related-card" href="/sand-casting">
      <h3>Sand Casting</h3>
      <p>Explore a traditional casting method suitable for larger parts and flexible production volumes.</p>
      <span class="related-link">Learn more →</span>
    </a>

    <a class="mainpage-related-card" href="/lost-foam">
      <h3>Lost Foam Casting</h3>
      <p>Discover a casting process that eliminates cores and enables complex geometries with high accuracy.</p>
      <span class="related-link">Learn more →</span>
    </a>

    <a class="mainpage-related-card" href="/casting-matrix">
      <h3>Casting Matrix</h3>
      <p>Compare casting technologies based on tolerances, cost, geometry, and production volume.</p>
      <span class="related-link">Learn more →</span>
    </a>

  </div>
</section>

<!-- CTA -->
<section class="mainpage-cta">
  <p>Looking for advanced sand-based casting solutions with design flexibility and precision?</p>
  <a href="/contact" class="cta-button">Get in Touch</a>
</section>


</main>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/bottombar.php'; ?>
