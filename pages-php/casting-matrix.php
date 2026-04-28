
<?php require_once __DIR__ . '/../includes/seo.php';?>
<?php include '../includes/head.php'; ?> 
<?php include '../includes/header.php'; ?>

<!-- CSS e JS específicos -->
<link rel="stylesheet" href="/assets/css/pages-css/casting-matrix.css">


<main class="matrix-content">

  <!-- HERO SECTION -->
  <section class="matrix-hero hero-fullimage"
           style="background-image: url('/assets/img/hero/casting-matrix.webp');">
    <div class="hero-overlay"></div>
    <div class="hero-text">
      <h1>Casting Matrix</h1>
      <p>Compare casting technologies — analyze tolerances, materials, and cost efficiency for optimal process selection.</p>
    </div>
  </section>

  <!-- INTRODUCTION -->
  <section class="matrix-intro">
    <p>
      The <strong>EDS Casting Matrix</strong> provides a side-by-side comparison of the main casting processes 
      applied in modern manufacturing. It helps engineers and buyers evaluate parameters such as 
      dimensional tolerances, surface finish, material compatibility, production cost, and process limitations.
    </p>
  </section>



<!-- TABLE SECTION --> 
<section class="matrix-table-section">
  <h2>Technical Comparison Table</h2>
  <div class="matrix-table-container">
    <table class="casting-matrix-table">
      <thead>
        <tr>
          <th>Property</th>
          <th>Sand Casting</th>
          <th>Investment Casting (Water Glass)</th>
          <th>Investment Casting (Silica Sol)</th>
          <th>Shell Moulding</th>
          <th>Gravity Die Casting</th>
          <th>High Pressure Die Casting</th>
          <th>Lost Foam Casting</th>
          <th>Sintering</th>
        </tr>
      </thead>
      <tbody>
        <tr><td><strong>Metals</strong></td><td>Ferrous & Non-Ferrous</td><td>Most Ferrous</td><td>Most Ferrous</td><td>Most Ferrous</td><td>Only Non-Ferrous</td><td>Only Non-Ferrous</td><td>Most Ferrous</td><td>Ferrous & Non-Ferrous</td></tr>
        <tr><td><strong>Size of Components</strong></td><td>All sizes</td><td>Small–Medium</td><td>Small–Medium</td><td>Small–Medium</td><td>Small–Large</td><td>Small–Medium</td><td>Medium</td><td>Very Small</td></tr>
        <tr><td><strong>Weight (kg)</strong></td><td>0.01 – Many tonnes</td><td>0.01 – 20 (max 50)</td><td>0.01 – 10 (max 50)</td><td>0.01 – 10+</td><td>0.01 – 75 (max 300)</td><td>0.01 – 10 (max 40)</td><td>1 – 200</td><td>0.05 – 1</td></tr>
        <tr><td><strong>Design Flexibility</strong></td><td>High</td><td>Very High</td><td>High</td><td>High</td><td>Moderate</td><td>Relatively High</td><td>High</td><td>Moderate</td></tr>
        <tr><td><strong>Production Unit (pcs)</strong></td><td>1 – 1000</td><td>10 – 500</td><td>10 – 500</td><td>100+</td><td>1000+</td><td>10,000+</td><td>500 – 1000</td><td>10,000+</td></tr>
        <tr><td><strong>Tooling Cost</strong></td><td>$</td><td>$</td><td>$</td><td>$$</td><td>$$</td><td>$$$</td><td>$$$</td><td>$$$$</td></tr>
        <tr><td><strong>Secondary Machining</strong></td><td>High</td><td>Moderate</td><td>Low</td><td>Low</td><td>Moderate</td><td>Very Low</td><td>Low</td><td>None</td></tr>
        <tr><td><strong>Manufacture Cost</strong></td><td>Low</td><td>Low</td><td>Medium</td><td>Medium</td><td>Low</td><td>Medium</td><td>Medium/High</td><td>Very High</td></tr>
        <tr><td><strong>Dimensional Tolerance (ISO 8062)</strong></td><td>CT10–CT12</td><td>CT7–CT9</td><td>CT4–CT6</td><td>CT7–CT8</td><td>CT7–CT8</td><td>CT4–CT5</td><td>CT7–CT8</td><td>CT1–CT2</td></tr>
        <tr><td><strong>Min. Wall Thickness (mm)</strong></td><td>6 – 8</td><td>4 – 5</td><td>2</td><td>5</td><td>4</td><td>2.5</td><td>3</td><td>3 – 4</td></tr>
        <tr><td><strong>Draft Angle (°)</strong></td><td>±2.0°</td><td>±1.0°</td><td>±0.5°</td><td>±1.0°</td><td>±1.0°</td><td>±0.5°</td><td>±1.5°</td><td>±0.1°</td></tr>
        <tr><td><strong>Surface Finish (Ra µm)</strong></td><td>Ra 50</td><td>Ra 25</td><td>Ra 3.2</td><td>Ra 25</td><td>Ra 12.5</td><td>Ra 3.2</td><td>Ra 25</td><td>Ra 3.2</td></tr>
      </tbody>
    </table>
    <p class="matrix-note">
      <strong>Note:</strong> Some values estimated based on internal expertise and industry benchmarks when official data was unavailable.
    </p>
  </div>
</section>


    <!-- INTERACTIVE GRAPH SECTION -->
  <section class="matrix-graph">
    <h2>Dimensional Accuracy & Minimum Wall Thickness Comparison</h2>
    <canvas id="castingChart"></canvas>
    <p class="graph-note">This chart illustrates the balance between process precision (ISO 8062 CT) and minimum cast wall thickness.</p>
  </section>


  <!-- INTERNAL LINKING SECTION -->
<section class="matrix-related-links" aria-labelledby="related-links-title">
  <div class="matrix-related-links__inner">
    <div class="matrix-related-links__intro">
      <span class="matrix-related-links__eyebrow">Related casting pages</span>
      <h2 id="related-links-title">Explore related casting processes and technical pages</h2>
      <p>
        Compare casting routes, review process capabilities, and navigate directly to the most relevant manufacturing pages for your component requirements, dimensional targets, and production goals.
      </p>
    </div>

    <div class="matrix-related-links__grid">
      <a class="matrix-related-card" href="/sand-casting">
        <h3>Sand Casting</h3>
        <p>Review a versatile process for complex geometries, larger parts, and cost-efficient production in ferrous and non-ferrous alloys.</p>
        <span>Explore page</span>
      </a>

      <a class="matrix-related-card" href="/investment">
        <h3>Investment Casting</h3>
        <p>Discover a process suited for fine detail, tighter tolerances, and lower machining requirements on precision components.</p>
        <span>Explore page</span>
      </a>

      <a class="matrix-related-card" href="/shell-moulding">
        <h3>Shell Moulding</h3>
        <p>See how shell moulding supports repeatability, improved surface finish, and consistent dimensional performance.</p>
        <span>Explore page</span>
      </a>

      <a class="matrix-related-card" href="/gravity-die">
        <h3>Gravity Die Casting</h3>
        <p>Understand when permanent mould casting is the right option for repeatable non-ferrous components and stable quality.</p>
        <span>Explore page</span>
      </a>

      <a class="matrix-related-card" href="/high-pressure-die">
        <h3>High Pressure Die Casting</h3>
        <p>Evaluate high-volume production for lightweight non-ferrous parts requiring strong repeatability and fine surface finish.</p>
        <span>Explore page</span>
      </a>

      <a class="matrix-related-card" href="/lost-foam">
        <h3>Lost Foam Casting</h3>
        <p>Learn more about a casting route that enables intricate shapes and simplified mould construction for selected applications.</p>
        <span>Explore page</span>
      </a>

      <a class="matrix-related-card" href="/sintering">
        <h3>Sintering</h3>
        <p>Compare powder-based manufacturing for small, precise parts where repeatability and near-net-shape efficiency are priorities.</p>
        <span>Explore page</span>
      </a>

      <a class="matrix-related-card" href="/contact">
        <h3>Talk to Our Engineering Team</h3>
        <p>Share your component requirements and get guidance on the best casting route based on geometry, material, and production volume.</p>
        <span>Request support</span>
      </a>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="matrix-cta">
  <p>Need assistance selecting the right casting method for your next project?  
    Our engineers can guide you through design conversion, cost optimization, and quality improvements.</p>
  <a href="/contact" class="cta-button">Get in Touch</a>
</section>

</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script defer src="/assets/js/casting-matrix.js"></script>
<?php include '../includes/footer.php'; ?>
<?php include '../includes/bottombar.php'; ?>
