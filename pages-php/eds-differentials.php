<?php require_once __DIR__ . '/../includes/seo.php'; ?>
<?php include(__DIR__ . '/../includes/head.php'); ?>
<?php include(__DIR__ . '/../includes/header.php'); ?>

<main class="eds-diff-page">

  <!-- =========================================================
       HERO
       CSS block: .eds-diff-hero
  ========================================================== -->
  <section
    class="eds-diff-hero"
    aria-labelledby="eds-diff-hero-title"
    style="background-image: url('/assets/img/hero/dif-hero-optimized.webp');"
  >
    <div class="eds-diff-hero__overlay" aria-hidden="true"></div>

    <div class="eds-diff-hero__content">
      <h1 class="eds-diff-hero__title" id="eds-diff-hero-title">
        Engineering-Led Casting, Forging and Supply Support
      </h1>

      <p class="eds-diff-hero__text">
        EDS combines engineering review, supplier coordination, quality documentation and logistics
        support to help industrial customers reduce casting and forging sourcing complexity,
        operational risk and total manufacturing costs.
      </p>

      <div class="eds-diff-hero__actions" aria-label="EDS Differentials actions">
        <a class="eds-diff-hero__button eds-diff-hero__button--primary" href="/contact">
          Request Engineering Support
        </a>
        <a class="eds-diff-hero__button eds-diff-hero__button--secondary" href="/workflow">
          View Our Workflow
        </a>
      </div>
    </div>
  </section>

  <?php
    $edsBreadcrumbItems = [
      ['label' => 'Home', 'url' => '/'],
      ['label' => 'EDS Differentials', 'url' => '/eds-differentials'],
    ];
    include __DIR__ . '/../includes/breadcrumbs.php';
  ?>

  <!-- =========================================================
       ANCHOR NAVIGATION
       CSS block: .eds-diff-nav
  ========================================================== -->
  <nav class="eds-diff-nav" aria-label="EDS Differentials page navigation">
    <a class="eds-diff-nav__link" href="#engineering-review">Engineering Review</a>
    <a class="eds-diff-nav__link" href="#cost-efficiency">Cost Efficiency</a>
    <a class="eds-diff-nav__link" href="#quality-control">Quality Control</a>
    <a class="eds-diff-nav__link" href="#supplier-network">Supplier Network</a>
    <a class="eds-diff-nav__link" href="#european-project-support">Project Support</a>
    <a class="eds-diff-nav__link" href="#sustainability">Sustainability</a>
  </nav>

  <div class="eds-diff-content">

    <!-- =========================================================
         WHY EDS
         CSS block: .eds-diff-why
    ========================================================== -->
    <section class="eds-diff-why" id="why-eds" aria-labelledby="eds-diff-why-title">
      <div class="eds-diff-why__text">
        <p class="eds-diff-why__eyebrow">Why EDS</p>
        <h2 class="eds-diff-why__title" id="eds-diff-why-title">
          A practical bridge between engineering, manufacturing and supply chain execution
        </h2>
        <p class="eds-diff-why__paragraph">
          EDS is not only a commercial contact between customer and supplier. Our value lies in how we
          review technical requirements, align the correct manufacturing route, coordinate production
          partners and support the documentation and logistics required for reliable industrial supply.
        </p>
        <p class="eds-diff-why__paragraph">
          This approach gives customers one clear European point of coordination while still benefiting
          from a global network of casting, forging, machining and finishing capabilities.
        </p>
      </div>

      <div class="eds-diff-why__cards" aria-label="EDS differential highlights">
        <article class="eds-diff-why-card">
          <h3 class="eds-diff-why-card__title">Technical clarity</h3>
          <p class="eds-diff-why-card__text">
            We help translate drawings, requirements and application needs into practical manufacturing decisions.
          </p>
        </article>

        <article class="eds-diff-why-card">
          <h3 class="eds-diff-why-card__title">Controlled sourcing</h3>
          <p class="eds-diff-why-card__text">
            Supplier selection is guided by process capability, quality expectations and project requirements.
          </p>
        </article>

        <article class="eds-diff-why-card">
          <h3 class="eds-diff-why-card__title">Cost awareness</h3>
          <p class="eds-diff-why-card__text">
            We focus on reducing unnecessary complexity, avoidable rework and inefficient sourcing routes.
          </p>
        </article>
      </div>
    </section>

    <!-- =========================================================
         ENGINEERING REVIEW
         CSS block: .eds-diff-engineering
    ========================================================== -->
    <section class="eds-diff-engineering" id="engineering-review" aria-labelledby="eds-diff-engineering-title">
      <div class="eds-diff-engineering__content">
        <p class="eds-diff-engineering__eyebrow">Engineering Review</p>
        <h2 class="eds-diff-engineering__title" id="eds-diff-engineering-title">
          Technical decisions before production starts
        </h2>
        <p class="eds-diff-engineering__paragraph">
          Engineering is the starting point of the EDS approach. Before a component moves into sourcing
          or production follow-up, we review the technical context: drawings, material requirements,
          tolerances, geometry, application conditions and expected manufacturing process.
        </p>
        <p class="eds-diff-engineering__paragraph">
          This helps identify potential risks earlier, supports better process selection and improves
          communication between the customer, EDS and the selected supplier.
        </p>
      </div>

      <aside class="eds-diff-engineering-card" aria-label="Engineering review focus areas">
        <h3 class="eds-diff-engineering-card__title">Review focus</h3>
        <ul class="eds-diff-engineering-card__list">
          <li class="eds-diff-engineering-card__item">Drawing and specification review</li>
          <li class="eds-diff-engineering-card__item">Material and process suitability</li>
          <li class="eds-diff-engineering-card__item">Manufacturability evaluation</li>
          <li class="eds-diff-engineering-card__item">Tooling and production feasibility</li>
          <li class="eds-diff-engineering-card__item">Risk reduction before order execution</li>
        </ul>
      </aside>
    </section>

    <!-- =========================================================
         COST EFFICIENCY
         CSS block: .eds-diff-cost
    ========================================================== -->
    <section class="eds-diff-cost" id="cost-efficiency" aria-labelledby="eds-diff-cost-title">
      <p class="eds-diff-cost__eyebrow">Cost Efficiency</p>
      <h2 class="eds-diff-cost__title" id="eds-diff-cost-title">
        Reducing total cost through better industrial coordination
      </h2>
      <p class="eds-diff-cost__paragraph">
        The lowest unit price is not always the lowest total cost. Delays, quality issues, unclear
        documentation, wrong process selection and inefficient logistics can quickly increase the real
        cost of industrial components.
      </p>
      <p class="eds-diff-cost__paragraph">
        EDS helps customers reduce total operational cost by combining engineering review, supplier
        capability alignment, quality follow-up and supply chain coordination into one structured process.
      </p>

      <div class="eds-diff-cost__links" aria-label="Related EDS services">
        <a class="eds-diff-cost__link" href="/casting-matrix">Casting processes</a>
        <a class="eds-diff-cost__link" href="/forging">Forging solutions</a>
        <a class="eds-diff-cost__link" href="/machining">Machining support</a>
        <a class="eds-diff-cost__link" href="/supply-chain">Supply chain coordination</a>
      </div>
    </section>

    <!-- =========================================================
         QUALITY CONTROL / HOW WE WORK
         CSS block: .eds-diff-quality
    ========================================================== -->
    <section class="eds-diff-quality" id="quality-control" aria-labelledby="eds-diff-quality-title">
      <div class="eds-diff-quality__header">
        <p class="eds-diff-quality__eyebrow">How We Work</p>
        <h2 class="eds-diff-quality__title" id="eds-diff-quality-title">
          Quality, documentation and follow-up throughout the project
        </h2>
        <p class="eds-diff-quality__intro">
          EDS supports customers beyond quotation and order placement. We help coordinate technical
          documentation, inspection expectations, supplier communication and delivery follow-up so that
          the project remains controlled from requirement review to final delivery.
        </p>
      </div>

      <div class="eds-diff-quality__cards" aria-label="Quality control and follow-up areas">
        <article class="eds-diff-quality-card">
          <h3 class="eds-diff-quality-card__title">Documentation control</h3>
          <p class="eds-diff-quality-card__text">
            We support the review and coordination of material certificates, dimensional reports,
            chemical analysis records, coating documentation and project-specific requirements.
          </p>
          <a class="eds-diff-quality-card__link" href="/quality">Explore quality support</a>
        </article>

        <article class="eds-diff-quality-card">
          <h3 class="eds-diff-quality-card__title">Process follow-up</h3>
          <p class="eds-diff-quality-card__text">
            We keep communication active between customer, supplier and internal stakeholders to reduce
            delays and avoid unclear responsibilities during production and delivery.
          </p>
          <a class="eds-diff-quality-card__link" href="/workflow">View workflow</a>
        </article>

        <article class="eds-diff-quality-card">
          <h3 class="eds-diff-quality-card__title">Supplier coordination</h3>
          <p class="eds-diff-quality-card__text">
            We align supplier capabilities with component requirements, helping reduce sourcing risk and
            improve reliability across different manufacturing processes.
          </p>
          <a class="eds-diff-quality-card__link" href="/supply-chain">See supply chain support</a>
        </article>
      </div>
    </section>

    <!-- =========================================================
         SUPPLIER NETWORK / CORE DIFFERENTIALS
         CSS block: .eds-diff-supplier
    ========================================================== -->
    <section class="eds-diff-supplier" id="supplier-network" aria-labelledby="eds-diff-supplier-title">
      <div class="eds-diff-supplier__header">
        <p class="eds-diff-supplier__eyebrow">Core Differentials</p>
        <h2 class="eds-diff-supplier__title" id="eds-diff-supplier-title">
          Global supplier access with European project coordination
        </h2>
        <p class="eds-diff-supplier__intro">
          EDS gives industrial customers access to a supplier network while maintaining clear project
          coordination from the Netherlands. This combination supports flexibility, technical alignment
          and structured communication across international supply chains.
        </p>
      </div>

      <div class="eds-diff-supplier__cards" aria-label="EDS core differentials">
        <article class="eds-diff-supplier-card">
          <h3 class="eds-diff-supplier-card__title">Engineering mindset</h3>
          <p class="eds-diff-supplier-card__text">
            Technical requirements are treated as the basis of sourcing, not as a detail after quotation.
          </p>
        </article>

        <article class="eds-diff-supplier-card">
          <h3 class="eds-diff-supplier-card__title">Supplier capability</h3>
          <p class="eds-diff-supplier-card__text">
            Production partners are selected according to process suitability, capacity and project needs.
          </p>
        </article>

        <article class="eds-diff-supplier-card">
          <h3 class="eds-diff-supplier-card__title">Quality awareness</h3>
          <p class="eds-diff-supplier-card__text">
            Documentation and inspection expectations are part of the supply process from the beginning.
          </p>
        </article>

        <article class="eds-diff-supplier-card">
          <h3 class="eds-diff-supplier-card__title">Supply reliability</h3>
          <p class="eds-diff-supplier-card__text">
            Logistics and communication are coordinated to reduce uncertainty and support delivery planning.
          </p>
        </article>

        <article class="eds-diff-supplier-card">
          <h3 class="eds-diff-supplier-card__title">Cost reduction</h3>
          <p class="eds-diff-supplier-card__text">
            We help reduce unnecessary complexity, rework, sourcing risk and inefficient production choices.
          </p>
        </article>

        <article class="eds-diff-supplier-card">
          <h3 class="eds-diff-supplier-card__title">Industrial flexibility</h3>
          <p class="eds-diff-supplier-card__text">
            Casting, forging, machining, finishing and assemblies can be combined according to project scope.
          </p>
        </article>
      </div>
    </section>

    <!-- =========================================================
         EUROPEAN PROJECT SUPPORT
         CSS block: .eds-diff-support
    ========================================================== -->
    <section class="eds-diff-support" id="european-project-support" aria-labelledby="eds-diff-support-title">
      <div class="eds-diff-support__content">
        <p class="eds-diff-support__eyebrow">European Project Support</p>
        <h2 class="eds-diff-support__title" id="eds-diff-support-title">
          A clear point of contact for complex industrial sourcing
        </h2>
        <p class="eds-diff-support__paragraph">
          Working with international suppliers can create communication gaps between purchasing,
          engineering, quality and logistics. EDS helps close that gap by acting as a structured
          coordination partner for customers and suppliers.
        </p>
        <p class="eds-diff-support__paragraph">
          Our role is to keep the technical and operational sides connected, helping customers move from
          requirement to quotation, production follow-up, documentation and delivery with more clarity.
        </p>
      </div>

      <aside class="eds-diff-support-card" aria-label="EDS project support highlight">
        <span class="eds-diff-support-card__label">Engineering</span>
        <h3 class="eds-diff-support-card__title">Design. Supply. Coordination.</h3>
        <p class="eds-diff-support-card__text">
          The EDS model connects technical reasoning with practical supply chain execution, helping
          customers reduce complexity while maintaining focus on quality and delivery.
        </p>
      </aside>
    </section>

    <!-- =========================================================
         SUSTAINABILITY
         CSS block: .eds-diff-sustainability
    ========================================================== -->
    <section class="eds-diff-sustainability" id="sustainability" aria-labelledby="eds-diff-sustainability-title">
      <div class="eds-diff-sustainability__header">
        <p class="eds-diff-sustainability__eyebrow">Sustainability &amp; Efficiency</p>
        <h2 class="eds-diff-sustainability__title" id="eds-diff-sustainability-title">
          Better decisions can reduce waste, rework and unnecessary logistics
        </h2>
        <p class="eds-diff-sustainability__intro">
          Sustainability in industrial sourcing starts with better technical and operational decisions.
          By selecting suitable processes, reviewing manufacturability and improving coordination, EDS
          helps reduce avoidable waste, rework and inefficient supply chain movements.
        </p>
      </div>

      <div class="eds-diff-sustainability__cards" aria-label="Sustainability and efficiency benefits">
        <article class="eds-diff-sustainability-card">
          <h3 class="eds-diff-sustainability-card__title">Material efficiency</h3>
          <p class="eds-diff-sustainability-card__text">
            Improved process selection can reduce unnecessary mass, machining and scrap.
          </p>
        </article>

        <article class="eds-diff-sustainability-card">
          <h3 class="eds-diff-sustainability-card__title">Reduced rework</h3>
          <p class="eds-diff-sustainability-card__text">
            Clear requirements and documentation support fewer misunderstandings during production.
          </p>
        </article>

        <article class="eds-diff-sustainability-card">
          <h3 class="eds-diff-sustainability-card__title">Supply chain efficiency</h3>
          <p class="eds-diff-sustainability-card__text">
            Better coordination supports more predictable planning and fewer avoidable disruptions.
          </p>
        </article>
      </div>
    </section>

    <!-- =========================================================
         EXPLORE MORE
         CSS block: .eds-diff-explore
    ========================================================== -->
    <section class="eds-diff-explore" aria-labelledby="eds-diff-explore-title">
      <div class="eds-diff-explore__header">
        <p class="eds-diff-explore__eyebrow">Explore EDS</p>
        <h2 class="eds-diff-explore__title" id="eds-diff-explore-title">
          Continue through the EDS website
        </h2>
        <p class="eds-diff-explore__intro">
          Learn more about our capabilities, quality approach, workflow and selected project experience.
        </p>
      </div>

      <div class="eds-diff-explore__cards" aria-label="Continue through the EDS website">
        <a class="eds-diff-explore-card" href="/casting-matrix">
          <span class="eds-diff-explore-card__label">Process selection</span>
          <strong class="eds-diff-explore-card__title">Casting Matrix</strong>
        </a>

        <a class="eds-diff-explore-card" href="/quality">
          <span class="eds-diff-explore-card__label">Documentation &amp; control</span>
          <strong class="eds-diff-explore-card__title">Quality</strong>
        </a>

        <a class="eds-diff-explore-card" href="/workflow">
          <span class="eds-diff-explore-card__label">Project process</span>
          <strong class="eds-diff-explore-card__title">Workflow</strong>
        </a>

        <a class="eds-diff-explore-card" href="/projects">
          <span class="eds-diff-explore-card__label">Selected work</span>
          <strong class="eds-diff-explore-card__title">Projects</strong>
        </a>
      </div>
    </section>

    <!-- =========================================================
         FINAL CTA
         CSS block: .eds-diff-cta
    ========================================================== -->
    <section class="eds-diff-cta" aria-labelledby="eds-diff-cta-title">
      <div class="eds-diff-cta__content">
        <p class="eds-diff-cta__eyebrow">Start a Project</p>
        <h2 class="eds-diff-cta__title" id="eds-diff-cta-title">
          Need engineering-backed support for industrial components?
        </h2>
        <p class="eds-diff-cta__text">
          Whether you are developing a new part, improving an existing supply chain or reviewing supplier
          options, EDS can support you with technical coordination and practical execution.
        </p>
      </div>

      <div class="eds-diff-cta__actions" aria-label="Start a project actions">
        <a class="eds-diff-cta__button eds-diff-cta__button--primary" href="/contact">
          Contact EDS
        </a>
        <a class="eds-diff-cta__button eds-diff-cta__button--secondary" href="/our-team">
          Meet Our Team
        </a>
      </div>
    </section>

  </div>
</main>

<?php include(__DIR__ . '/../includes/footer.php'); ?>
<?php include(__DIR__ . '/../includes/bottombar.php'); ?>
