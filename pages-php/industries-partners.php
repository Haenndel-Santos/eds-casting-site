<?php require_once __DIR__ . '/../includes/seo.php';?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/header.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
  function initCarousel(selector, speed = 0.8) {
    const carouselSection = document.querySelector(selector);
    if (!carouselSection) return;

    const carouselWrapper = carouselSection.querySelector('.carousel-wrapper');
    const carouselTrack = carouselSection.querySelector('.carousel-track');
    if (!carouselWrapper || !carouselTrack) return;

    let scrollSpeed = speed;
    let scrollPosition = 0;
    let paused = false;

    const items = Array.from(carouselTrack.children);
    items.forEach(item => {
      const clone = item.cloneNode(true);
      clone.setAttribute('aria-hidden', 'true');
      carouselTrack.appendChild(clone);
    });

    function scrollLoop() {
      if (!paused) {
        scrollPosition += scrollSpeed;
        if (scrollPosition >= carouselTrack.scrollWidth / 2) {
          scrollPosition = 0;
        }
        carouselWrapper.scrollLeft = scrollPosition;
      }
      requestAnimationFrame(scrollLoop);
    }

    scrollLoop();

    carouselWrapper.addEventListener('mouseenter', () => paused = true);
    carouselWrapper.addEventListener('mouseleave', () => paused = false);
  }

  initCarousel('.industries-carousel', 0.6);

  const enablePartnersCarousel = false;
  if (enablePartnersCarousel) {
    initCarousel('.partners-carousel', 0.8);
  }
});
</script>

<main class="ind-part-content">

  <!-- HERO SECTION -->
  <section class="ind-part-hero hero-fullimage"
           style="background-image: url('/assets/img/hero/industries.webp');">
    <div class="hero-overlay"></div>
    <div class="hero-text">
      <h1>Industries &amp; Partners</h1>
      <h1>We are</h1>
      <h1>everywhere.</h1>
    </div>
  </section>

  <!-- INTRODUCTION -->
  <section class="ind-part-section ind-part-overview">
    <h2>Engineering Support Across Industries</h2>
    <p>
      EDS supports customers across multiple industrial sectors by combining casting, forging, machining, surface finishing,
      assemblies, and supply chain management into a coordinated engineering solution. Our approach focuses on matching
      each component requirement with the most suitable manufacturing process and production strategy.
    </p>
  </section>

  <!-- INDUSTRY APPLICATIONS -->
<section class="ind-part-section ind-part-industry-applications">
  <h2>Industry-Focused Engineering Solutions</h2>
  <p>
    Each industry presents different technical challenges — from wear resistance and structural
    strength to dimensional accuracy, corrosion protection, and long-term supply stability.
    EDS supports these requirements through a flexible manufacturing network and application-driven
    engineering approach.
  </p>

  <div class="related-grid">
    <div class="mainpage-related-card">
      <h3>Railway &amp; Transport Applications</h3>
      <p>Projects focused on structural components, outdoor durability, and repeatable production for railway and transport systems.</p>
      <a href="/projects" class="related-link">View projects →</a>
    </div>

    <div class="mainpage-related-card">
      <h3>Industrial &amp; Hydraulics Applications</h3>
      <p>Examples of machined housings, manifolds, and precision components where dimensional control and consistency are critical.</p>
      <a href="/projects" class="related-link">View projects →</a>
    </div>

    <div class="mainpage-related-card">
      <h3>Heavy Equipment &amp; Wear Applications</h3>
      <p>Solutions developed for excavating, demolition, and agriculture sectors with focus on wear life, strength, and reliability.</p>
      <a href="/projects" class="related-link">View projects →</a>
    </div>
  </div>
</section>


  <!-- INDUSTRIES ICON CAROUSEL -->
  <section class="ind-part-carousel industries-carousel">
    <h2>Main Industries We Serve</h2>
    <div class="carousel-wrapper">
      <div class="carousel-track">
        <div class="carousel-item"><img src="/assets/img/icons/automotive.svg" alt="Automotive industry"><p>Automotive</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/construction.svg" alt="Construction industry"><p>Construction</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/railway.svg" alt="Railway industry"><p>Railway</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/energy.svg" alt="Energy industry"><p>Energy</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/marine.svg" alt="Marine industry"><p>Marine</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/agriculture.svg" alt="Agriculture industry"><p>Agriculture</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/mining.svg" alt="Mining industry"><p>Mining</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/oilgas.svg" alt="Oil and gas industry"><p>Oil &amp; Gas</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/infrastructure.svg" alt="Infrastructure industry"><p>Infrastructure</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/industrial.svg" alt="Industrial sector"><p>Industrial</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/offshore.svg" alt="Offshore sector"><p>Offshore</p></div>
        <div class="carousel-item"><img src="/assets/img/icons/demolition.svg" alt="Demolition sector"><p>Demolition</p></div>
      </div>
    </div>
  </section>

  <!-- PROJECTS CONNECTION -->
  <section class="ind-part-section alt ind-part-projects-link">
    <h2>See How Our Solutions Perform in Real Applications</h2>
    <p>
      Our project portfolio presents real engineering cases across railway, industrial systems, hydraulics,
      transport, heavy equipment, and other demanding sectors. These examples demonstrate how EDS connects
      technical requirements with practical manufacturing solutions and long-term supply strategies.
    </p>
    <a href="/projects" class="cta-button">Explore Our Projects</a>
  </section>

  <!-- GLOBAL REACH -->
  <section class="ind-part-section">
    <h2>Global Supply Network</h2>
    <p>
      EDS operates through an international network of qualified suppliers, combining European engineering standards
      with global manufacturing capabilities. This allows us to provide cost-efficient, reliable, and scalable production
      solutions adapted to each project.
    </p>
    <ul class="ind-part-list">
      <li>Qualified supplier network across Europe and Asia</li>
      <li>Integrated quality control and inspection processes</li>
      <li>Coordinated logistics and delivery planning</li>
    </ul>
  </section>

  <!-- PARTNERS INTRO -->
  <section class="ind-part-section alt partners-intro">
    <h2>Trusted Partnerships</h2>
    <p>
      Our partner network includes foundries, forging specialists, machining suppliers, and logistics providers.
      These collaborations are built on long-term cooperation, quality consistency, and aligned technical expectations.
    </p>
  </section>

<!-- PARTNERS LOGO CAROUSEL -->
 <!-- <section class="ind-part-carousel partners-carousel">
    <h2>Our Partners</h2>
    <div class="carousel-wrapper">
      <div class="carousel-track">
        <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/zanardi.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
        <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/futrifer.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
        <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/elcee.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
        <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/artech.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
        <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/somafel.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
          <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/somafel.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
          <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/somafel.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
          <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/somafel.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
          <div class="carousel-item square">
          <a href="https://www.edscasting.com" target="_blank">
            <img src="/assets/img/partners/somafel.png" alt="Partner">
            <p>Partner</p>
          </a>
        </div>
      </div>
    </div>
  </section>-->

  <!-- INTERNAL LINKING SECTION -->
  <section class="ind-part-section mainpage-related">
    <h2>Related Processes and Services</h2>

    <div class="related-grid">
      <a class="mainpage-related-card" href="/casting-matrix">
        <h3>Casting Solutions</h3>
        <p>Explore casting processes used across multiple industries for complex geometries and serial production.</p>
        <span class="related-link">Learn more →</span>
      </a>

      <a class="mainpage-related-card" href="/forging">
        <h3>Forging Solutions</h3>
        <p>Discover forging methods for applications requiring strength, grain flow control, and mechanical performance.</p>
        <span class="related-link">Learn more →</span>
      </a>

      <a class="mainpage-related-card" href="/projects">
        <h3>Project Portfolio</h3>
        <p>Review real engineering cases across railway, industrial, hydraulics, and heavy equipment sectors.</p>
        <span class="related-link">Learn more →</span>
      </a>
    </div>
  </section>

  <!-- CTA -->
  <section class="mainpage-cta">
    <p>Looking for an engineering partner that understands your industry and delivers reliable manufacturing solutions?</p>
    <a href="/contact" class="cta-button">Get in Touch</a>
  </section>

</main>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/bottombar.php'; ?>
