<?php
/**
 * /public_html/includes/header.php
 * Unified responsive header with overlay navigation
 */
?>
<header class="eds-header-alt">

  <div class="header-top-stripe"></div>

  <div class="eds-header-inner">
    <div class="eds-logo-container">
      <a href="/" aria-label="EDS Home">
        <img src="/assets/img/logo/logo-main.png" alt="EDS Logo" class="eds-logo">
      </a>
    </div>

    <nav class="eds-quicknav" aria-label="Primary navigation">
      <a href="/about-us" class="quicknav-item quicknav-item--secondary">Institutional</a>
      <a href="/eds-differentials" class="quicknav-item quicknav-item--secondary">Differentials</a>
      <a href="/projects" class="quicknav-item quicknav-item--primary">Projects</a>
      <a href="/industries-partners" class="quicknav-item quicknav-item--primary">Industries &amp; Partners</a>
      <!--<a href="/original-parts" class="quicknav-item quicknav-item--primary">Original Projects</a>-->
      <a href="/contact" class="quicknav-cta">Contact Us</a>
    </nav>

    <button
      id="menuToggle"
      class="menu-toggle-btn"
      type="button"
      aria-label="Open menu"
      aria-controls="menuOverlay"
      aria-expanded="false"
    >
      <span class="menu-icon-bars" aria-hidden="true"></span>
      <span>Menu</span>
    </button>
  </div>

  <div class="header-bottom-stripe"></div>
</header>

<div id="menuOverlay" class="menu-overlay hidden" aria-hidden="true">
  <div class="menu-popup" role="dialog" aria-modal="true" aria-label="Site menu" onclick="event.stopPropagation()">

    <div class="menu-popup-header">
      <div class="menu-brand-block">
        <p class="menu-brand-name">EDS Casting &amp; Forging</p>
        <p class="menu-brand-subtitle">Engineering-driven sourcing for casting, forging and industrial components</p>
      </div>

      <div class="menu-header-actions" aria-label="Menu quick actions">
        <a class="menu-header-cta" href="/contact#request-quotation">Request a Quotation</a>
        <button
          id="menuClose"
          class="menu-close-btn"
          type="button"
          aria-label="Close menu"
        >
          &times;
        </button>
      </div>
    </div>

    <section class="menu-project-support" aria-labelledby="menu-project-support-title">
      <div>
        <p class="menu-project-support__eyebrow">Project Support</p>
        <h3 id="menu-project-support-title">Technical and commercial support pages</h3>
      </div>
      <nav class="menu-project-support__links" aria-label="Project support navigation">
        <a href="/projects">Projects</a>
        <a href="/workflow">Workflow</a>
        <a href="/quality">Quality</a>
        <a href="/industries-partners">Industries &amp; Partners</a>
        <a href="/contact">Contact</a>
      </nav>
    </section>

    <div class="menu-columns">
      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Company</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/">Home</a></li>
          <li><a href="/about-us">About Us</a></li>
          <li><a href="/eds-differentials">EDS Differentials</a></li>
          <li><a href="/our-team">Our Team</a></li>
          <li><a href="/careers">Work at EDS</a></li>
          <li><a href="/faq">FAQ</a></li>
        </ul>
      </div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Casting</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/casting-matrix">Casting Matrix</a></li>
          <li><a href="/sand-casting">Sand Casting</a></li>
          <li><a href="/shell-moulding">Shell Moulding Casting</a></li>
          <li><a href="/investment">Investment Casting</a></li>
          <li><a href="/gravity-die">Gravity Die Casting</a></li>
          <li><a href="/high-pressure-die">High Pressure Die Casting</a></li>
          <li><a href="/lost-foam">Lost Foam Casting</a></li>
          <li><a href="/sintering">Sintering</a></li>
        </ul>
      </div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Forging</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/forging">Forging</a></li>
          <li><a href="/closed-die">Closed Die Forging</a></li>
          <li><a href="/open-die">Open Die Forging</a></li>
          <li><a href="/multi-directional">Multi Directional Forging</a></li>
          <li><a href="/rolled-ring">Rolled Ring Forgings</a></li>
        </ul>
      </div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Value-Added Services</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/machining">Machining</a></li>
          <li><a href="/assemblies">Assemblies</a></li>
          <li><a href="/surface-finishing">Surface Finishing</a></li>
          <li><a href="/sand-print3d">3D Sand Printing</a></li>
          <li><a href="/printed-cores-3d">3D Cores Printing</a></li>
        </ul>
      </div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Logistics &amp; Supply</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/supply-chain">Supply Chain</a></li>
          <li><a href="/warehousing">Warehousing</a></li>
        </ul>
      </div>

    </div>

    <div class="menu-footer">
      <p class="company-name">EDS Casting &amp; Forging B.V.</p>
      <p class="company-city">Amsterdam, NL</p>
      <p class="menu-footer__contact">
        <a class="company-phone" href="tel:+31203585066">+31 20 358 5066</a>
        <a class="company-email" href="mailto:info@edsinnovation.com">info@edsinnovation.com</a>
      </p>
    </div>
  </div>
</div>

<button class="back-to-top" type="button" aria-label="Back to top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
  <span aria-hidden="true">&uarr;</span>
</button>

<a class="fixed-quote-cta" href="/contact#request-quotation" aria-label="Request a quote" data-eds-track data-eds-event="commercial_cta_click" data-eds-label="fixed_quote_cta" data-eds-category="global_header">
  <span>Request a Quote</span>
</a>

<?php include(__DIR__ . '/../includes/cookies-banner.php'); ?>
