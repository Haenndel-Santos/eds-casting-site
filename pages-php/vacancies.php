<?php
require_once __DIR__ . '/../includes/seo.php';
require_once __DIR__ . '/../includes/content-loader.php';

/* Vacancies uses the shared process-page visual system for consistency. */
$useMainPagesCss = true;

$careerRoles = eds_sort_by_order(eds_filter_public_items(eds_load_data('careers.php', [])));
$openCareerRoles = array_values(array_filter($careerRoles, static function ($role): bool {
  return ($role['status'] ?? '') === 'open' && ($role['is_active'] ?? false) === true;
}));
$primaryVacancy = $openCareerRoles[0] ?? null;

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<main class="process-page vacancies-page">

  <!-- HERO -->
  <section
    class="process-hero vacancies-hero"
    aria-labelledby="vacancies-hero-title"
    style="background-image: url('/assets/img/hero/careers-optimized.webp');"
  >
    <div class="process-hero__overlay" aria-hidden="true"></div>

    <div class="process-hero__content">
      <h1 id="vacancies-hero-title">Current Job Opportunities at EDS</h1>

      <p class="process-hero__summary">
        Explore open positions at EDS Casting &amp; Forging and join a technical, international team working with
        industrial customers, engineering documentation, supplier coordination and global manufacturing projects.
      </p>

      <div class="process-hero__actions" aria-label="Vacancies page actions">
        <?php if ($primaryVacancy): ?>
          <a class="process-btn process-btn--primary" href="#technical-account-specialist">View Open Position</a>
        <?php else: ?>
          <a class="process-btn process-btn--primary" href="/careers">Submit General Application</a>
        <?php endif; ?>
        <a class="process-btn process-btn--secondary" href="/careers">Submit General Application</a>
      </div>
    </div>
  </section>

  <!-- ANCHOR NAVIGATION -->
  <nav class="process-anchor-nav" aria-label="Vacancies page navigation">
    <a href="#overview">Overview</a>
    <?php if ($primaryVacancy): ?>
      <a href="#technical-account-specialist">Open Position</a>
      <a href="#responsibilities">Responsibilities</a>
      <a href="#profile">Profile</a>
      <a href="#offer">What We Offer</a>
      <a href="#apply">Apply</a>
    <?php endif; ?>
  </nav>

  <div class="process-content">

    <!-- INTRODUCTION -->
    <section class="process-section process-intro" id="overview" aria-labelledby="vacancies-overview-title">
      <div class="process-intro__text">
        <p class="process-eyebrow">Vacancies</p>
        <h2 id="vacancies-overview-title">Build your career in technical sales, engineering support and industrial sourcing</h2>
        <p>
          EDS Casting &amp; Forging supports industrial customers with casting, forging, machining, surface treatment,
          assemblies, quality documentation and international supplier coordination. Our vacancies are connected
          to real technical products and practical customer requirements.
        </p>
        <p>
          We look for people who can communicate clearly, understand technical details, work with customers and
          suppliers, and take ownership of the process from inquiry to delivery. In our environment, commercial
          work and technical understanding are strongly connected.
        </p>
        <p>
          <?php if ($primaryVacancy): ?>
            Below you can find our current open position. If this role does not match your profile, you can still
            send a general application through our careers page for future opportunities.
          <?php else: ?>
            Currently there are no open vacancies. However, EDS is always open to hearing from motivated technical
            and commercial professionals.
          <?php endif; ?>
        </p>
      </div>

      <div class="process-intro__cards" aria-label="Vacancies page highlights">
        <article>
          <h3>Technical Products</h3>
          <p>Work with castings, forgings, machined components, materials, drawings and industrial applications.</p>
        </article>

        <article>
          <h3>Customer Contact</h3>
          <p>Support customer relationships by connecting technical requirements with commercial follow-up.</p>
        </article>

        <article>
          <h3>International Scope</h3>
          <p>Coordinate with customers, suppliers and production partners across the Netherlands, Europe and abroad.</p>
        </article>
      </div>
    </section>

    <?php if ($primaryVacancy): ?>
    <!-- OPEN POSITION SUMMARY -->
    <section class="process-section vacancies-position" id="technical-account-specialist" aria-labelledby="position-title">
      <div class="vacancy-label-row">
        <span class="vacancy-status">Open Position</span>
        <span class="vacancy-location">Amsterdam, Netherlands</span>
      </div>

      <div class="process-section__header">
        <p class="process-eyebrow">Inside Sales / Technical Commercial Support</p>
        <h2 id="position-title">Technical Account Specialist — Inside Sales</h2>
        <p>
          As a Technical Account Specialist at EDS, you support the link between customers, engineering, suppliers
          and production follow-up. You help translate customer requests into clear technical and commercial actions,
          while supporting quotation follow-up, order coordination and long-term customer relationships.
        </p>
      </div>

      <div class="vacancy-summary-grid" aria-label="Technical Account Specialist vacancy summary">
        <article>
          <strong>Role type</strong>
          <span>Technical commercial role / Inside sales</span>
        </article>

        <article>
          <strong>Experience</strong>
          <span>Minimum 2 years in a technical-commercial environment</span>
        </article>

        <article>
          <strong>Languages</strong>
          <span>Dutch and English required</span>
        </article>

        <article>
          <strong>Development path</strong>
          <span>Growth toward external account support and customer-facing responsibilities</span>
        </article>
      </div>
    </section>

    <!-- ROLE -->
    <section class="process-section process-split" aria-labelledby="role-title">
      <div>
        <p class="process-eyebrow">The Role</p>
        <h2 id="role-title">A commercial support role with strong technical connection</h2>
        <p>
          In this role, you work closely with customers and colleagues to understand requests, clarify technical
          details, support quotations and follow up on orders. You will be involved in customer communication,
          technical coordination, supplier contact and commercial support.
        </p>
        <p>
          Over time, you will develop both technical and commercial skills, with the possibility to grow toward
          more independent customer-facing responsibilities. The position is suited for someone who enjoys technical
          products, customer relationships and structured follow-up.
        </p>
      </div>

      <aside class="process-callout process-callout--neutral" aria-label="Technical Account Specialist role fit">
        <h3>This role fits someone who</h3>
        <ul>
          <li>Enjoys technical products and industrial customers</li>
          <li>Communicates clearly with customers and colleagues</li>
          <li>Can balance commercial goals with technical details</li>
          <li>Works in a structured and responsible way</li>
          <li>Wants to grow with a small, technical and international team</li>
        </ul>
      </aside>
    </section>

    <!-- RESPONSIBILITIES -->
    <section class="process-section" id="responsibilities" aria-labelledby="responsibilities-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Responsibilities</p>
        <h2 id="responsibilities-title">What you will do</h2>
        <p>
          The position combines customer contact, quotation support, order follow-up and coordination with internal
          and external stakeholders. You will gradually build knowledge of EDS products, customers and processes.
        </p>
      </div>

      <div class="process-grid-3 vacancies-card-grid">
        <article class="process-card">
          <h3>Customer relationship support</h3>
          <p>
            Maintain and develop customer relationships from inside sales, supporting questions, requests and
            commercial follow-up in a professional way.
          </p>
        </article>

        <article class="process-card">
          <h3>Technical quotation follow-up</h3>
          <p>
            Support quotations together with engineering and production partners, including specifications,
            requirements, planning and commercial details.
          </p>
        </article>

        <article class="process-card">
          <h3>Order coordination</h3>
          <p>
            Help guide customer orders from inquiry to delivery, coordinating specifications, supplier input,
            documentation, timing and internal communication.
          </p>
        </article>

        <article class="process-card">
          <h3>Supplier and purchasing coordination</h3>
          <p>
            Support purchasing and supplier communication for customer projects, in coordination with production,
            engineering and logistics.
          </p>
        </article>

        <article class="process-card">
          <h3>Sales collaboration</h3>
          <p>
            Work with the sales team to follow opportunities, support commercial targets and improve the customer
            experience through reliable communication.
          </p>
        </article>

        <article class="process-card">
          <h3>Customer visits and fairs</h3>
          <p>
            Join customer visits and trade fairs when relevant, helping build market knowledge and long-term
            customer relationships.
          </p>
        </article>
      </div>
    </section>

    <!-- PROFILE -->
    <section class="process-section process-section--soft" id="profile" aria-labelledby="profile-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Candidate Profile</p>
        <h2 id="profile-title">Who we are looking for</h2>
        <p>
          We are looking for a team member with technical curiosity, commercial drive and the ability to work in a
          structured way. Experience in a technical or industrial environment is important, but willingness to learn
          and take ownership is equally valuable.
        </p>
      </div>

      <div class="vacancy-requirements-grid">
        <article>
          <h3>Experience and education</h3>
          <ul class="vacancies-list">
            <li>Minimum 2 years of experience in a technical-commercial role, inside sales, sales support or technical customer support.</li>
            <li>Affinity with engineering, metalworking, industrial products or production processes.</li>
            <li>HBO working and thinking level, or equivalent practical experience.</li>
          </ul>
        </article>

        <article>
          <h3>Skills and mindset</h3>
          <ul class="vacancies-list">
            <li>Strong communication skills and customer-focused attitude.</li>
            <li>Analytical, structured and solution-oriented way of working.</li>
            <li>Commercial drive without losing attention to technical content.</li>
            <li>Good command of Dutch and English, both spoken and written.</li>
          </ul>
        </article>
      </div>
    </section>

    <!-- OFFER -->
    <section class="process-section" id="offer" aria-labelledby="offer-title">
      <div class="process-section__header">
        <p class="process-eyebrow">What We Offer</p>
        <h2 id="offer-title">A role with responsibility, learning and international technical exposure</h2>
        <p>
          EDS offers a practical working environment where you can grow commercially and technically. You will work
          with a close team, international customers, industrial products and projects where your initiative and
          follow-up make a visible difference.
        </p>
      </div>

      <div class="process-grid-3 vacancies-card-grid">
        <article class="process-card">
          <h3>Clear development path</h3>
          <p>
            Develop toward more independent customer-facing responsibilities as your technical and commercial
            knowledge grows.
          </p>
        </article>

        <article class="process-card">
          <h3>Technical team environment</h3>
          <p>
            Work in a small, close and technical team where collaboration, knowledge sharing and initiative matter.
          </p>
        </article>

        <article class="process-card">
          <h3>International work</h3>
          <p>
            Support customers and suppliers across different countries while working with high-quality industrial products.
          </p>
        </article>
      </div>
    </section>

    <!-- APPLY CTA -->
    <section class="process-section process-final-cta vacancies-apply-cta" id="apply" aria-labelledby="apply-title">
      <div>
        <p class="process-eyebrow">Apply Now</p>
        <h2 id="apply-title">Interested in this Technical Account Specialist position?</h2>
        <p>
          Send your application and CV using the button below. We will review your profile and contact you if there
          is a suitable match for the role.
        </p>
      </div>

      <div class="process-final-cta__actions">
        <button id="applyBtn" class="process-btn process-btn--primary" type="button" aria-haspopup="dialog" aria-controls="applyPopup">
          Apply for this Position
        </button>
        <a class="process-btn process-btn--secondary" href="/careers">General Application</a>
      </div>
    </section>

    <?php endif; ?>

    <!-- RELATED -->
    <section class="process-section process-section--dark" id="related" aria-labelledby="related-title">
      <div class="process-section__header">
        <p class="process-eyebrow">Explore EDS</p>
        <h2 id="related-title">Learn more about EDS before applying</h2>
        <p>
          Explore how EDS works with casting, forging, quality support and industrial supply chain coordination.
        </p>
      </div>

      <div class="process-related-grid">
        <a class="process-related-card" href="/about-us">
          <h3>About EDS</h3>
          <p>Learn more about our company, values and engineering-driven role in industrial sourcing.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/eds-differentials">
          <h3>How EDS Works</h3>
          <p>Explore our support for casting, forging, machining, finishing and logistics coordination.</p>
          <span>Learn more</span>
        </a>

        <a class="process-related-card" href="/quality">
          <h3>Quality Support</h3>
          <p>See how documentation, inspection and supplier follow-up support customer confidence.</p>
          <span>Learn more</span>
        </a>
      </div>
    </section>

  </div>
</main>

<!-- APPLICATION POPUP FORM -->
<div id="applyPopup" class="vacancy-popup-overlay" aria-hidden="true">
  <div class="vacancy-popup-box" role="dialog" aria-modal="true" aria-labelledby="vacancy-popup-title">
    <button class="close-popup" type="button" aria-label="Close application form">&times;</button>

    <h2 id="vacancy-popup-title">Apply for Technical Account Specialist</h2>
    <p class="vacancy-popup-intro">
      Please complete the form below and upload your CV in PDF format.
    </p>

    <form id="applyForm" action="/vacancies-mail" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="position" value="Technical Account Specialist - Inside Sales">

      <div class="vacancy-form-field">
        <label for="applicantName">Full Name</label>
        <input type="text" id="applicantName" name="name" required autocomplete="name">
      </div>

      <div class="vacancy-form-field">
        <label for="applicantEmail">Email Address</label>
        <input type="email" id="applicantEmail" name="email" required autocomplete="email">
      </div>

      <div class="vacancy-form-field">
        <label for="applicantPhone">Phone Number</label>
        <input type="text" id="applicantPhone" name="phone" required autocomplete="tel">
      </div>

      <div class="vacancy-form-field">
        <label for="applicantCV">Upload CV <span>(PDF only)</span></label>
        <input type="file" id="applicantCV" name="cv" accept=".pdf,application/pdf" required>
      </div>

      <!-- CAPTCHA -->
      <div class="g-recaptcha" data-sitekey="6LeWDOArAAAAAFKopj1_XZIoQIJTupCJzKEdJAtz"></div>

      <!-- HONEYPOT FIELD -->
      <div class="honeypot-field" aria-hidden="true">
        <label for="website">Website</label>
        <input type="text" id="website" name="website" autocomplete="off" tabindex="-1">
      </div>

      <button type="submit" class="process-btn process-btn--primary vacancy-submit-btn">Submit Application</button>
    </form>
  </div>
</div>

<!-- SUCCESS POPUP -->
<div id="thankyouPopup" class="vacancy-popup-overlay" aria-hidden="true">
  <div class="vacancy-popup-box vacancy-popup-box--small" role="dialog" aria-modal="true" aria-labelledby="thankyou-title">
    <h2 id="thankyou-title">Thank you!</h2>
    <p>Your application has been received. Our team will contact you if your profile matches the position.</p>
    <button id="closeThankyou" class="process-btn process-btn--primary" type="button">Close</button>
  </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const applyBtn = document.getElementById('applyBtn');
  const applyPopup = document.getElementById('applyPopup');
  const closePopup = document.querySelector('.close-popup');
  const thankyouPopup = document.getElementById('thankyouPopup');
  const closeThankyou = document.getElementById('closeThankyou');
  const applyForm = document.getElementById('applyForm');

  function openModal(modal) {
    if (!modal) return;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
  }

  function closeModal(modal) {
    if (!modal) return;
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
  }

  if (applyBtn) {
    applyBtn.addEventListener('click', () => openModal(applyPopup));
  }

  if (closePopup) {
    closePopup.addEventListener('click', () => closeModal(applyPopup));
  }

  if (closeThankyou) {
    closeThankyou.addEventListener('click', () => closeModal(thankyouPopup));
  }

  [applyPopup, thankyouPopup].forEach((modal) => {
    if (!modal) return;
    modal.addEventListener('click', (event) => {
      if (event.target === modal) {
        closeModal(modal);
      }
    });
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeModal(applyPopup);
      closeModal(thankyouPopup);
    }
  });

  if (applyForm) {
    applyForm.addEventListener('submit', async function (event) {
      event.preventDefault();

      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.textContent : '';

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
      }

      try {
        const formData = new FormData(this);
        const response = await fetch(this.action, {
          method: 'POST',
          body: formData
        });

        if (!response.ok) {
          throw new Error('Application submission failed.');
        }

        closeModal(applyPopup);
        openModal(thankyouPopup);
        this.reset();

        if (typeof grecaptcha !== 'undefined') {
          grecaptcha.reset();
        }
      } catch (error) {
        alert('An error occurred while submitting your application. Please try again.');
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = originalText;
        }
      }
    });
  }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
<?php include __DIR__ . '/../includes/bottombar.php'; ?>
