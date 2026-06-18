<?php
require_once __DIR__ . '/../includes/seo.php';

/* Careers uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<?php if (isset($_GET['sent']) && $_GET['sent'] === 'success'): ?>
  <div class="careers-popup-overlay" role="dialog" aria-modal="true" aria-labelledby="careers-popup-title">
    <div class="careers-popup">
      <h3 id="careers-popup-title">Thank you for your application!</h3>
      <p>Your CV has been successfully received and added to our database.</p>
      <p>Our team will review your profile and contact you if a suitable opportunity becomes available.</p>
      <button id="closePopup" class="careers-popup-btn" type="button">Close</button>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const popup = document.querySelector('.careers-popup-overlay');
      const closeBtn = document.getElementById('closePopup');

      if (popup && closeBtn) {
        closeBtn.addEventListener('click', () => {
          popup.classList.add('hidden');
          history.replaceState(null, '', '/careers');
        });
      }
    });
  </script>
<?php endif; ?>

<main class="process-page careers-page">

  <!-- HERO -->
  <section
    class="process-hero careers-hero"
    aria-labelledby="careers-hero-title"
    style="background-image: url('/assets/img/hero/careers-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="careers-hero-title">Careers at EDS Casting &amp; Forging</h1>

      <p class="process-hero__summary">
        Join a technical and international team supporting industrial customers with casting, forging,
        machining, quality documentation and supply chain coordination across global manufacturing projects.
      </p>

      <div class="process-hero__actions" aria-label="Careers page actions">
        <a class="process-btn process-btn--primary" href="#application">Submit Your Application</a>
        <a class="process-btn process-btn--secondary" href="/vacancies">Check Our Opportunities</a>
      </div>
    </div>
  </section>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="Careers page navigation">
    <a href="#overview">Overview</a>
    <a href="#culture">Culture</a>
    <a href="#career-paths">Career Paths</a>
    <a href="#internships">Internships</a>
    <a href="#application">Apply</a>
    <a href="#related">Explore EDS</a>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="overview" aria-labelledby="careers-overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">Work at EDS</p>
        <h2 id="careers-overview-title">A practical engineering environment connected to real industrial projects</h2>
        <p>
          EDS Casting &amp; Forging works with industrial components that require technical understanding,
          supplier coordination, quality documentation and reliable follow-up. Our work connects engineering,
          purchasing, logistics, quality control and customer communication in one operational flow.
        </p>
        <p>
          We are not a mass-production foundry. EDS operates as an engineering and trading partner, coordinating
          castings, forgings, machined parts and value-added manufacturing through qualified external suppliers.
          This creates a work environment where technical clarity, ownership and problem-solving matter every day.
        </p>
        <p>
          Whether you are experienced or still developing your professional path, EDS offers opportunities to work
          with practical industrial challenges, international suppliers and customers, and projects where details
          directly influence quality, cost and delivery reliability.
        </p>
      </div>

      <div class="process-intro__cards" aria-label="Why work at EDS">
        <article>
          <h3>Technical Exposure</h3>
          <p>Work with drawings, materials, casting and forging processes, machining, inspection and supplier documentation.</p>
        </article>

        <article>
          <h3>International Projects</h3>
          <p>Coordinate with customers and production partners across Europe and global supplier networks.</p>
        </article>

        <article>
          <h3>Operational Impact</h3>
          <p>Support decisions that influence cost, delivery performance, quality control and customer confidence.</p>
        </article>
      </div>
    </section>

    <!-- CULTURE -->
    <section class="process-section process-split" id="culture" aria-labelledby="culture-title">
      <div>
        <p class="process-eyebrow">Our Culture</p>
        <h2 id="culture-title">Clear communication, accountability and continuous improvement</h2>
        <p>
          Our culture is built around practical problem-solving. We value people who ask the right questions,
          take responsibility for details and communicate clearly with colleagues, suppliers and customers.
        </p>
        <p>
          EDS projects often involve technical drawings, material certificates, inspection reports, production
          planning and logistics deadlines. Because of this, we look for people who are precise, curious and willing
          to learn how industrial products move from technical requirements to delivered components.
        </p>
      </div>

      <aside class="process-callout process-callout--neutral" aria-label="EDS work culture highlights">
        <h3>What we value</h3>
        <ul>
          <li>Clear communication and ownership</li>
          <li>Technical curiosity and attention to detail</li>
          <li>Structured follow-up and reliability</li>
          <li>Teamwork across engineering, quality and operations</li>
          <li>Continuous improvement in processes and documentation</li>
        </ul>
      </aside>
    </section>

    <!-- CAREER PATHS -->
    <section class="process-section" id="career-paths" aria-labelledby="career-paths-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Career Paths</p>
        <h2 id="career-paths-title">Opportunities connected to engineering, operations and industrial supply</h2>
        <p>
          EDS offers roles and development paths for people interested in technical products, customer support,
          documentation, sourcing, logistics and process coordination. The exact opportunities depend on current
          business needs and available vacancies.
        </p>
      </div>

      <div class="process-grid-3 careers-card-grid">
        <article class="process-card">
          <h3>Engineering &amp; Product Support</h3>
          <p>
            Work with drawings, material specifications, manufacturing feasibility, supplier questions and technical
            clarification for casting, forging and machining projects.
          </p>
          <a href="/eds-differentials">Explore how EDS works</a>
        </article>

        <article class="process-card">
          <h3>Quality &amp; Documentation</h3>
          <p>
            Support material certificates, measurement reports, inspection records, supplier documentation and
            customer-specific quality requirements.
          </p>
          <a href="/quality">Explore quality support</a>
        </article>

        <article class="process-card">
          <h3>Supply Chain &amp; Logistics</h3>
          <p>
            Coordinate supplier follow-up, production status, delivery planning, stock support and communication
            across international manufacturing projects.
          </p>
          <a href="/supply-chain">Explore supply chain</a>
        </article>
      </div>
    </section>

    <!-- ENGINEERING EXCELLENCE -->
    <section class="process-section process-section--soft" aria-labelledby="engineering-excellence-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Engineering Mindset</p>
        <h2 id="engineering-excellence-title">Precision, documentation and supplier coordination in daily work</h2>
        <p>
          A career at EDS is connected to practical industrial execution. Our team works with real component
          requirements, supplier limitations, technical documentation and customer expectations. This creates a
          learning environment where engineering awareness and operational discipline develop together.
        </p>
      </div>

      <div class="process-grid-3 careers-card-grid">
        <article class="process-card">
          <h3>Manufacturing knowledge</h3>
          <p>
            Learn how casting, forging, machining, surface treatment and assembly decisions affect component cost,
            quality and performance.
          </p>
        </article>

        <article class="process-card">
          <h3>Project coordination</h3>
          <p>
            Follow industrial projects from quotation and supplier review to production, inspection, shipment and
            customer communication.
          </p>
        </article>

        <article class="process-card">
          <h3>Quality awareness</h3>
          <p>
            Understand how documentation, traceability, measurement reports and supplier follow-up support reliable
            industrial sourcing.
          </p>
        </article>
      </div>
    </section>

    <!-- INTERNSHIPS -->
    <section class="process-section process-split" id="internships" aria-labelledby="internships-title">
      <div>
        <p class="process-eyebrow">Internships &amp; Development</p>
        <h2 id="internships-title">Internship opportunities for students interested in industrial products</h2>
        <p>
          EDS supports students and early-career professionals who want to understand technical products,
          manufacturing processes and international supply chain operations. Internships may involve engineering
          documentation, data organization, supplier communication, quality follow-up or process improvement tasks.
        </p>
        <p>
          We value people who are willing to learn, ask questions and contribute to practical improvements. A good
          internship project should help both the student and the company create something useful and measurable.
        </p>
      </div>

      <aside class="process-callout process-callout--neutral" aria-label="Internship focus areas">
        <h3>Possible focus areas</h3>
        <ul>
          <li>Engineering documentation and drawing review support</li>
          <li>Supplier data, certificates and quality records</li>
          <li>Supply chain and logistics process improvement</li>
          <li>Website, content, SEO or digital operations support</li>
          <li>Internal reporting and operational data organization</li>
        </ul>
      </aside>
    </section>

    <!-- APPLICATION FORM -->
    <section class="process-section careers-application-section" id="application" aria-labelledby="application-title">
      <div class="careers-form-header">
        <p class="process-eyebrow">Apply to EDS</p>
        <h2 id="application-title">Submit your application</h2>
        <p>
          Interested in joining EDS? Upload your CV below. We will keep your application in our database and contact
          you when a suitable opportunity becomes available.
        </p>
      </div>

      <form
        id="careerForm"
        class="careers-form"
        action="/careers-mail"
        method="POST"
        enctype="multipart/form-data"
      >
        <div class="careers-form-grid">
          <div class="careers-field">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required placeholder="Your full name" autocomplete="name">
          </div>

          <div class="careers-field">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="you@example.com" autocomplete="email">
          </div>

          <div class="careers-field careers-field--full">
            <label for="cv">Upload your CV <span>(PDF only)</span></label>
            <input type="file" id="cv" name="cv" accept=".pdf,application/pdf" required>
            <p class="careers-field-note">Please upload a PDF version of your resume or CV.</p>
          </div>
        </div>

        <!-- CAPTCHA -->
        <div class="g-recaptcha" data-sitekey="6LeWDOArAAAAAFKopj1_XZIoQIJTupCJzKEdJAtz"></div>

        <!-- HONEYPOT FIELD -->
        <div class="honeypot-field" aria-hidden="true">
          <label for="website">Website</label>
          <input type="text" id="website" name="website" autocomplete="off" tabindex="-1">
        </div>

        <button class="process-btn process-btn--primary careers-submit-btn" type="submit">Send Application</button>
      </form>

      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </section>

    <!-- RELATED -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Explore EDS</p>
        <h2 id="related-title">Learn more about the company before applying</h2>
        <p>
          Before submitting your application, you can explore how EDS works, what we do and how we support quality
          and supply chain coordination for industrial customers.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/about-us">
          <h3>About EDS</h3>
          <p>Learn more about our company, role in the market and engineering-driven sourcing approach.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/workflow">
          <h3>Workflow</h3>
          <p>See how EDS manages projects from technical review to supplier follow-up and delivery.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/quality">
          <h3>Quality Support</h3>
          <p>Understand how documentation, inspection and supplier coordination support customer confidence.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="process-section process-final-cta" aria-labelledby="careers-final-cta-title">
      <div>
        <p class="process-eyebrow">Open Opportunities</p>
        <h2 id="careers-final-cta-title">Looking for a specific vacancy?</h2>
        <p>
          Visit our vacancies page to see current opportunities. If there is no active vacancy that matches your
          profile, you can still submit your CV for future consideration.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <a class="process-btn process-btn--primary" href="/vacancies">Check Opportunities</a>
        <a class="process-btn process-btn--secondary" href="#application">Submit Your CV</a>
      </div>
    </section>

  </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
