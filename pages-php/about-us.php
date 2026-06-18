<?php require_once __DIR__ . '/../includes/seo.php'; ?>
<?php include(__DIR__ . '/../includes/head.php'); ?>
<?php include(__DIR__ . '/../includes/header.php'); ?>

<main class="about-us-page">

  <!-- HERO -->
  <section
    class="about-hero"
    aria-labelledby="about-hero-title"
    style="background-image: url('/assets/img/hero/about-us-hero1-optimized.webp');"
  >
    <div class="about-hero__overlay" aria-hidden="true"></div>

    <div class="about-hero__content">
      <h1 id="about-hero-title">Engineering, Design and Supply for European Industrial Components</h1>

      <p>
        EDS Casting &amp; Forging B.V. is a Netherlands-based engineering and supply partner
        supporting European industrial companies with castings, forgings, machined components,
        quality documentation and coordinated manufacturing supply.
      </p>

      <div class="about-hero__actions" aria-label="About EDS actions">
        <a class="about-btn about-btn--primary" href="/casting-matrix">Explore Casting Processes</a>
        <a class="about-btn about-btn--secondary" href="/contact">Contact EDS</a>
      </div>
    </div>
  </section>

  <?php
    $edsBreadcrumbItems = [
      ['label' => 'Home', 'url' => '/'],
      ['label' => 'About Us', 'url' => '/about-us'],
    ];
    include __DIR__ . '/../includes/breadcrumbs.php';
  ?>

  <!-- ANCHOR NAVIGATION -->
  <nav class="about-anchor-nav" aria-label="About EDS page navigation">
    <a href="#who-we-are">Who We Are</a>
    <a href="#our-role">Our Role</a>
    <a href="#how-we-work">How We Work</a>
    <a href="#mission-values">Mission &amp; Values</a>
    <a href="#history">History</a>
    <a href="#team">Team</a>
  </nav>

  <div class="about-content">

    <!-- INTRODUCTION -->

     
    <section class="about-intro" aria-labelledby="about-intro-title">
     
      <div class="about-intro__text">
        <p class="about-section-label">About Us</p>
        <h2 id="about-intro-title">A technical partner between product design, manufacturing and reliable supply</h2>
        <p>
          EDS was created to support industrial companies that need more than a supplier list.
          Our role is to connect drawings, material specifications and application requirements
          with suitable casting, forging, machining and finishing processes, qualified production
          partners and structured project follow-up.
        </p>
        <p>
          We work with customers who require dependable metal components and clear communication
          across engineering, purchasing, quality and logistics. From early manufacturability review
          to documentation and delivery coordination, EDS helps reduce supplier complexity, improve
          sourcing decisions and strengthen supply reliability.
        </p>
      </div>

      <div class="about-intro__cards" aria-label="EDS institutional strengths">
        <article>
                   <h3>Engineering-led sourcing</h3>
          <p>Drawings, specifications and application needs are reviewed before sourcing moves forward.</p>
        </article>

        <article>
                   <h3>Quality documentation</h3>
          <p>Support for certificates, inspection reports and technical documentation.</p>
        </article>

        <article>
                  <h3>European coordination</h3>
          <p>Netherlands-based project communication for industrial customers and manufacturing partners.</p>
        </article>
      </div>
    </section>

    <!-- WHO WE ARE -->
    <section class="about-section about-section--split" id="who-we-are" aria-labelledby="who-we-are-title">
      <div class="about-section__content">
        <p class="about-section-label">Who We Are</p>
        <h2 id="who-we-are-title">A multidisciplinary team focused on technical clarity and industrial execution</h2>
        <p>
          EDS brings together engineering knowledge, quality awareness and supply chain experience
          to support industrial projects from concept to delivery. We see ourselves as a practical
          partner for companies that need cast, forged and machined components with controlled
          specifications, supplier visibility and dependable execution.
        </p>
        <p>
          Our work is based on clear communication, technical discipline and long-term relationships.
          We help customers make better manufacturing decisions, avoid unnecessary supplier risk and
          keep industrial component projects aligned with cost, quality and delivery expectations.
        </p>
      </div>

      <aside class="about-callout" aria-label="EDS operating focus">
        <h3>Our operating focus</h3>
        <ul>
          <li>Engineering review before production</li>
          <li>Manufacturing process selection</li>
          <li>Supplier coordination and follow-up</li>
          <li>Quality documentation control</li>
          <li>Logistics and delivery coordination</li>
        </ul>
      </aside>
    </section>

    <!-- OUR ROLE -->
    <section class="about-section about-section--light" id="our-role" aria-labelledby="our-role-title">
      <p class="about-section-label">Our Role</p>
      <h2 id="our-role-title">Not just sourcing — engineering-backed supply coordination</h2>
      <p>
        EDS is not a foundry and does not position itself as a mass-production manufacturer. Our value
        lies in combining technical understanding with a qualified manufacturing network and structured
        project coordination. This allows customers to access suitable casting, forging, machining,
        finishing and assembly capabilities while keeping one clear engineering and supply contact in Europe.
      </p>

      <div class="about-service-links" aria-label="Related EDS services">
        <a href="/casting-matrix">Casting processes</a>
        <a href="/forging">Forging solutions</a>
        <a href="/machining">Machining support</a>
        <a href="/surface-finishing">Surface treatment</a>
        <a href="/supply-chain">Supply chain coordination</a>
      </div>
    </section>

    <!-- HOW WE WORK -->
    <section class="about-section" id="how-we-work" aria-labelledby="how-we-work-title">
      <div class="about-section__header">
        <p class="about-section-label">How We Work</p>
        <h2 id="how-we-work-title">From technical requirement to controlled delivery</h2>
        <p>
          Our workflow is built to reduce uncertainty in industrial sourcing. We review requirements,
          define the right production route, coordinate suppliers, follow up quality documentation and
          support logistics until the component reaches the customer.
        </p>
      </div>

      <div class="about-process-grid">
        <article>
          <h3> Technical review</h3>
          <p>
            We evaluate drawings, material requirements, tolerances and application conditions before
            selecting a suitable manufacturing route.
          </p>
          <a href="/eds-differentials">View EDS differentials</a>
        </article>

        <article>
          <h3>Supplier and process alignment</h3>
          <p>
            We align the part requirements with supplier capabilities, process feasibility and expected
            production conditions.
          </p>
          <a href="/workflow">See our workflow</a>
        </article>

        <article>
          <h3>Quality and delivery follow-up</h3>
          <p>
            We support quality documentation, inspection follow-up and logistics coordination to improve
            reliability throughout the supply chain.
          </p>
          <a href="/quality">Explore quality support</a>
        </article>
      </div>
    </section>

    <!-- MISSION & VALUES -->
    <section class="about-section about-section--values" id="mission-values" aria-labelledby="mission-values-title">
      <div class="about-section__header">
        <p class="about-section-label">Mission &amp; Values</p>
        <h2 id="mission-values-title">Built around reliability, efficiency and long-term partnership</h2>
        <p>
          Our mission is to provide engineering and supply solutions that combine technical quality,
          cost efficiency and responsible execution — helping customers source reliable metal components
          for demanding industrial markets.
        </p>
      </div>

      <div class="about-values-grid">
        <article>
          <h3>Integrity</h3>
          <p>We act transparently and build trust through clear communication and consistent follow-up.</p>
        </article>

        <article>
          <h3>Excellence</h3>
          <p>We aim for precision, discipline and continuous improvement in every project phase.</p>
        </article>

        <article>
          <h3>Partnership</h3>
          <p>We work with customers and suppliers as long-term partners, not as short-term transactions.</p>
        </article>

        <article>
          <h3>Efficiency</h3>
          <p>We help reduce unnecessary cost, complexity and operational risk in industrial sourcing.</p>
        </article>

        <article>
          <h3>Sustainability</h3>
          <p>We support better manufacturing decisions that reduce waste and improve process efficiency.</p>
        </article>

        <article>
          <h3>Commitment</h3>
          <p>We take ownership of project coordination and stay close to the details that matter.</p>
        </article>
      </div>
    </section>

    <!-- HISTORY -->
    <section class="about-section about-section--split" id="history" aria-labelledby="history-title">
      <div class="about-section__content">
        <p class="about-section-label">Our History</p>
        <h2 id="history-title">A company shaped by engineering curiosity and industrial component problem solving</h2>
        <p>
          Engineering and mechanics have been part of EDS’s story since before the company was founded.
          What began as curiosity for how machines work evolved into a long-term commitment to design,
          manufacturing and precision.
        </p>
        <p>
          That same mindset shaped EDS Casting &amp; Forging: a company built on the belief that strong
          industrial partnerships require both technical understanding and practical execution. From
          early interest in mechanical systems to international manufacturing coordination, EDS remains
          focused on delivering insight, reliability and value to every partnership.
        </p>
      </div>

      <aside class="about-history-card" aria-label="EDS history highlight">
        <span>Reliability</span>
        <h3>Engineering. Design. Supply. </h3>
        <p>
          The EDS approach connects technical reasoning with supplier coordination, helping customers
          move from concept to dependable industrial supply.
        </p>
      </aside>
    </section>

    <!-- EXPLORE MORE -->
    <section class="about-section about-section--explore" aria-labelledby="explore-eds-title">
      <div class="about-section__header">
        <p class="about-section-label">Explore EDS</p>
        <h2 id="explore-eds-title">Continue through the EDS website</h2>
        <p>
          Learn more about our capabilities, workflow, quality approach and industrial project experience.
        </p>
      </div>

      <div class="about-explore-grid">
        <a href="/casting-matrix">
          <span>Process selection</span>
          <strong>Casting Matrix</strong>
        </a>

        <a href="/quality">
          <span>Documentation &amp; control</span>
          <strong>Quality</strong>
        </a>

        <a href="/workflow">
          <span>Project process</span>
          <strong>Workflow</strong>
        </a>

        <a href="/projects">
          <span>Selected work</span>
          <strong>Projects</strong>
        </a>
      </div>
    </section>

    <!-- TEAM CTA -->
    <section class="about-final-cta" id="team" aria-labelledby="team-title">
      <div>
        <p class="about-section-label">Our Team</p>
        <h2 id="team-title">A practical team behind every technical project</h2>
        <p>
          Behind every project is a team committed to engineering clarity, customer support and reliable
          execution. Meet the people supporting EDS customers and supply partners.
        </p>
      </div>

      <div class="about-final-cta__actions">
        <a class="about-btn about-btn--primary" href="/our-team">Meet Our Team</a>
        <a class="about-btn about-btn--secondary" href="/contact">Start a Project</a>
      </div>
    </section>

  </div>

</main>

<?php include(__DIR__ . '/../includes/footer.php'); ?>
<?php include(__DIR__ . '/../includes/bottombar.php'); ?>
