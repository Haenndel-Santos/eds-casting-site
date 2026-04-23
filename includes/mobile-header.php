<!-- 🔵 Mobile Header - EDS Mobile Navigation -->
<link rel="stylesheet" href="/dev/assets/css/mobile.css">
<script src="/dev/assets/js/mobile-menu.js" defer></script>

<div class="mobile-top-stripe"></div>
<header class="mobile-header">
  <div class="mobile-logo">
    <img src="/dev/assets/img/logo.png" alt="EDS Logo">
  </div>
  <button class="hamburger" id="hamburgerBtn">
    &#9776;
  </button>
</header>

<nav class="mobile-nav" id="mobileNav">
  <ul>
    <li>
      <span class="menu-item">About Us</span>
      <button class="submenu-toggle">&#9662;</button>
      <ul class="submenu">
        <li><a href="/about-us/who-we-are.php">Who We Are</a></li>
        <li><a href="/about-us/our-mission.php">Our Mission</a></li>
        <li><a href="/about-us/our-expertise.php">Our Expertise</a></li>
        <li><a href="/about-us/our-team.php">Our Team</a></li>
      </ul>
    </li>
    <li>
      <span class="menu-item">What We Do</span>
      <button class="submenu-toggle">&#9662;</button>
      <ul class="submenu">
        <li><a href="/what-we-do/casting.php">Casting</a></li>
        <li><a href="/what-we-do/forging.php">Forging</a></li>
        <li><a href="/what-we-do/add-value.php">Add Value</a></li>
        <li><a href="/what-we-do/logistics.php">Logistics</a></li>
      </ul>
    </li>
    <li><a href="/projects/">Projects</a></li>
    <li><a href="/workflow/">Workflow</a></li>
    <li><a href="/industries-partners/">Industries & Partners</a></li>
    <li><a href="/quality/">Quality</a></li>
    <li><a href="/contact/">Contact</a></li>
  </ul>
</nav>

<section class="mobile-hero main-image">
  <img src="/dev/assets/img/hero-main.jpg" alt="Main Hero">
</section>

<section class="mobile-hero slider">
  <img src="/dev/assets/img/hero-slide1.jpg" alt="Slide 1">
</section>

<footer class="mobile-footer">
  <p><strong>EDS Casting & Forging B.V.</strong><br>
  Amsterdam, Netherlands<br>
  Phone: +31 20 123 4567<br>
  Email: info@edscasting.com</p>
</footer>

<script>
  const hamburger = document.getElementById('hamburgerBtn');
  const mobileNav = document.getElementById('mobileNav');
  const submenuToggles = document.querySelectorAll('.submenu-toggle');

  hamburger.addEventListener('click', () => {
    mobileNav.classList.toggle('active');
  });

  submenuToggles.forEach(button => {
    button.addEventListener('click', () => {
      const submenu = button.nextElementSibling;
      submenu.classList.toggle('open');
      button.classList.toggle('rotated');
    });
  });
