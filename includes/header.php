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
      <a href="/workflow" class="quicknav-item quicknav-item--primary">Workflow</a>
      <a href="/projects" class="quicknav-item quicknav-item--primary">Projects</a>
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
      <a href="/" class="menu-home">Home</a>
      <button
        id="menuClose"
        class="menu-close-btn"
        type="button"
        aria-label="Close menu"
      >
        &times;
      </button>
    </div>

    <div class="menu-columns">
	<div class="menu-column menu-column--highlight">
  <ul>
    <li>
      <a href="/projects" class="menu-highlight-link">Projects</a>
    </li>
  </ul>
</div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Casting</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/casting-matrix">Casting Matrix</a></li>
          <li><a href="/gravity-die">Gravity Die Casting</a></li>
          <li><a href="/high-pressure-die">High Pressure Die Casting</a></li>
          <li><a href="/investment">Investment Casting</a></li>
          <li><a href="/lost-foam">Lost Foam Casting</a></li>
          <li><a href="/sand-casting">Sand Casting</a></li>
          <li><a href="/shell-moulding">Shell Moulding Casting</a></li>
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
          <li><a href="/multi-directional">Multi Directional Forging</a></li>
          <li><a href="/open-die">Open Die Forging</a></li>
          <li><a href="/rolled-ring">Rolled Ring Forgings</a></li>
        </ul>
      </div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Add Value</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/sand-print3d">3D Sand Printing</a></li>
          <li><a href="/printed-cores-3d">3D Cores Printing</a></li>
          <li><a href="/assemblies">Assemblies</a></li>
          <li><a href="/machining">Machining</a></li>
          <li><a href="/surface-finishing">Surface Treatment</a></li>
        </ul>
      </div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">Logistics</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/supply-chain">Supply Chain</a></li>
          <li><a href="/warehousing">Warehousing</a></li>
        </ul>
      </div>

      <div class="menu-column menu-column--accordion">
        <button class="menu-section-toggle" type="button" aria-expanded="false">
          <span class="menu-section-title">General</span>
          <span class="menu-section-icon" aria-hidden="true">+</span>
        </button>
        <ul class="menu-section-list">
          <li><a href="/about-us">About Us</a></li>
          <li><a href="/eds-differentials">EDS Differentials</a></li>
          <li><a href="/contact">Contact</a></li>
          <li><a href="/faq">FAQ</a></li>
          <li><a href="/industries-partners">Industries &amp; Partners</a></li>
          <li><a href="/our-team">Our Team</a></li>
          <li><a href="/careers">Work at EDS</a></li>
        </ul>
      </div>

    </div>

    <div class="menu-footer">
      <p>
        <span class="company-name">EDS Casting &amp; Forging B.V.</span><br>
        <span class="company-city">Amsterdam, NL.</span>
        <a class="company-phone" href="tel:+31203585066">+31 020 358 5066</a><br>
        <a class="company-email" href="mailto:info@edsinnovation.com">info@edsinnovation.com</a>
      </p>
    </div>
  </div>
</div>

<?php include(__DIR__ . '/../includes/cookie-banner.php'); ?>