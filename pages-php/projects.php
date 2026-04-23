<?php 
// File: /pages-php/projects.php
// Purpose: Projects landing page with integrated portfolio filter, capped preview grid and inline JS

include (__DIR__ . '/../includes/head.php');
include (__DIR__ . '/../includes/header.php');
?>

<main class="projects-page" id="projects-page">

  <!-- PAGE HERO -->
  <section class="projects-hero" id="projects-hero">
    <div class="projects-hero__inner">
      <h1 class="projects-hero__title">Engineering Projects<br>&amp; Case Studies</h1>
      <p class="projects-hero__subtitle">
        Explore selected EDS projects across multiple industries and discover how we support
        performance, manufacturability, durability and long-term supply continuity.
      </p>
    </div>
  </section>

  <!-- PROJECT PORTFOLIO -->
  <section class="projects-portfolio" id="projects-portfolio">
    <div class="projects-portfolio__inner">

      <div class="projects-portfolio__heading">
        <span class="projects-portfolio__eyebrow">Selected engineering cases</span>
        <h2 class="projects-portfolio__title">Project Portfolio</h2>
        <p class="projects-portfolio__intro">
          This section presents selected EDS projects from different industries where we support
          customers with engineering input, manufacturing coordination and reliable sourcing solutions.
        </p>
      </div>

      <nav class="projects-portfolio__filters" aria-label="Project filters">
        <button class="projects-portfolio__filter is-active" type="button" data-filter="all" aria-pressed="true">All</button>
        <button class="projects-portfolio__filter" type="button" data-filter="railway" aria-pressed="false">Railway</button>
        <button class="projects-portfolio__filter" type="button" data-filter="industrial" aria-pressed="false">Industrial</button>
        <button class="projects-portfolio__filter" type="button" data-filter="transport" aria-pressed="false">Trucks &amp; Trailers</button>
        <button class="projects-portfolio__filter" type="button" data-filter="hydraulics" aria-pressed="false">Hydraulics</button>
        <button class="projects-portfolio__filter" type="button" data-filter="agriculture" aria-pressed="false">Agriculture</button>
        <button class="projects-portfolio__filter" type="button" data-filter="demolition" aria-pressed="false">Demolition</button>
      </nav>

      <div class="projects-portfolio__results" aria-live="polite">
        Showing <strong id="projectsPortfolioCount">9</strong> projects
      </div>

      <div class="projects-portfolio__grid" role="list">

        <article class="projects-portfolio-card" role="listitem" data-sector="demolition">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/tooth-rdp/thumbnail.webp" alt="Tooth RDP demolition project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Demolition</span>
            <h3 class="projects-portfolio-card__title">Tooth RDP</h3>
            <p class="projects-portfolio-card__text">
              Wear-intensive demolition component developed for demanding operating conditions,
              with focus on durability, impact resistance and service life extension.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>High wear resistance</li>
              <li>Impact-focused performance</li>
              <li>Extended service life</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Demolition</span>
              <span class="projects-portfolio-card__tag">Wear</span>
              <span class="projects-portfolio-card__tag">Durability</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/tooth-rdp">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="railway">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/slide-chair/thumbnail.webp" alt="Railway slide chair project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Railway</span>
            <h3 class="projects-portfolio-card__title">Slide Chair</h3>
            <p class="projects-portfolio-card__text">
              Structural railway component designed for stable support, repeatable production
              quality and dependable long-term field performance.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Reliable structural support</li>
              <li>Consistent batch quality</li>
              <li>Railway application focus</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Railway</span>
              <span class="projects-portfolio-card__tag">Support</span>
              <span class="projects-portfolio-card__tag">Quality</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/slide-chair">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="transport">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/counterweights/thumbnail.webp" alt="Counterweights transport project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Trucks &amp; Trailers</span>
            <h3 class="projects-portfolio-card__title">Counterweights</h3>
            <p class="projects-portfolio-card__text">
              Counterweight solution developed for transport equipment with emphasis on balance,
              structural reliability and repeatable production control.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Weight distribution support</li>
              <li>Reliable structural performance</li>
              <li>Production consistency</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Transport</span>
              <span class="projects-portfolio-card__tag">Trailers</span>
              <span class="projects-portfolio-card__tag">Balance</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/counterweights">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="agriculture">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/hubschwinge/thumbnail.webp" alt="Hubschwinge agricultural project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Agriculture</span>
            <h3 class="projects-portfolio-card__title">Hubschwinge</h3>
            <p class="projects-portfolio-card__text">
              Agricultural structural component developed for demanding machine conditions,
              combining durability, reliable geometry and field-ready performance.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Field durability</li>
              <li>Stable component geometry</li>
              <li>Application reliability</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Agriculture</span>
              <span class="projects-portfolio-card__tag">Structure</span>
              <span class="projects-portfolio-card__tag">Reliability</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/hubschwinge">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="industrial">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/worm-wormwheel-actuation/thumbnail.webp" alt="Worm and wormwheel actuation project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Industrial</span>
            <h3 class="projects-portfolio-card__title">Worm and Wormwheel Actuation</h3>
            <p class="projects-portfolio-card__text">
              Mechanical actuation project focused on controlled motion transfer, robust engagement
              and reliable performance for industrial systems.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Controlled motion transfer</li>
              <li>Robust mechanical engagement</li>
              <li>Reliable industrial use</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Industrial</span>
              <span class="projects-portfolio-card__tag">Actuation</span>
              <span class="projects-portfolio-card__tag">Mechanical</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/worm-wormwheel-actuation">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="hydraulics">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/pumphuis/thumbnail.webp" alt="Pump housing hydraulics project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Hydraulics</span>
            <h3 class="projects-portfolio-card__title">Pumphuis</h3>
            <p class="projects-portfolio-card__text">
              Pump housing project developed for hydraulic applications requiring dimensional stability,
              production consistency and dependable service performance.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Dimensional consistency</li>
              <li>Hydraulic application focus</li>
              <li>Stable production quality</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Hydraulics</span>
              <span class="projects-portfolio-card__tag">Pumps</span>
              <span class="projects-portfolio-card__tag">Housing</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/pumphuis">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="agriculture">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/butterfly-bolt/thumbnail.webp" alt="Butterfly bolt agricultural project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Agriculture</span>
            <h3 class="projects-portfolio-card__title">Butterfly Bolt</h3>
            <p class="projects-portfolio-card__text">
              Agricultural fastening component designed for reliable mounting, repeatable use
              and practical performance in field equipment applications.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Reliable fastening performance</li>
              <li>Repeatable field use</li>
              <li>Application-focused design</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Agriculture</span>
              <span class="projects-portfolio-card__tag">Fastening</span>
              <span class="projects-portfolio-card__tag">Field Use</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/butterfly-bolt">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="industrial">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/bearing-house/thumbnail.webp" alt="Bearing house paper industry project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Industrial / Paper Industry</span>
            <h3 class="projects-portfolio-card__title">Bearing House</h3>
            <p class="projects-portfolio-card__text">
              Bearing housing solution developed for paper industry applications where structural
              reliability, dimensional stability and long-term operation are essential.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Dimensional stability</li>
              <li>Rotating equipment support</li>
              <li>Long-term operational reliability</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Bearing</span>
              <span class="projects-portfolio-card__tag">Paper Industry</span>
              <span class="projects-portfolio-card__tag">Industrial</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/bearing-house">View case</a>
          </div>
        </article>

        <article class="projects-portfolio-card" role="listitem" data-sector="agriculture">
          <div class="projects-portfolio-card__media">
            <img src="/assets/img/projects/messentrager/thumbnail.webp" alt="Messentrager agricultural project component">
          </div>
          <div class="projects-portfolio-card__content">
            <span class="projects-portfolio-card__sector">Agriculture</span>
            <h3 class="projects-portfolio-card__title">Messenträger</h3>
            <p class="projects-portfolio-card__text">
              Agricultural blade-support component developed for stable operation, wear resistance
              and dependable performance in repetitive field conditions.
            </p>
            <ul class="projects-portfolio-card__bullets">
              <li>Wear-focused design</li>
              <li>Stable blade support</li>
              <li>Reliable repetitive use</li>
            </ul>
            <div class="projects-portfolio-card__tags" aria-label="Project tags">
              <span class="projects-portfolio-card__tag">Agriculture</span>
              <span class="projects-portfolio-card__tag">Wear</span>
              <span class="projects-portfolio-card__tag">Blade Support</span>
            </div>
            <a class="projects-portfolio-card__link" href="/projects/messentrager">View case</a>
          </div>
        </article>

      </div>

      <div class="projects-portfolio__footer" id="projectsPortfolioFooter">
        <a class="projects-portfolio__view-all" href="/contact">Discuss your project with us</a>
      </div>
    </div>
  </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const filterButtons = document.querySelectorAll('.projects-portfolio__filter');
  const cards = Array.from(document.querySelectorAll('.projects-portfolio-card'));
  const countElement = document.getElementById('projectsPortfolioCount');
  const grid = document.querySelector('.projects-portfolio__grid');
  const footer = document.getElementById('projectsPortfolioFooter');
  const MAX_ALL_CARDS = 9;

  if (!filterButtons.length || !cards.length || !countElement || !grid) {
    return;
  }

  let emptyState = null;

  function updateEmptyState(visibleCount) {
    if (visibleCount === 0) {
      if (!emptyState) {
        emptyState = document.createElement('div');
        emptyState.className = 'projects-portfolio__empty';
        emptyState.textContent = 'No projects found for this category yet.';
        grid.appendChild(emptyState);
      }
    } else if (emptyState) {
      emptyState.remove();
      emptyState = null;
    }
  }

  function setActiveButton(activeButton) {
    filterButtons.forEach(function (button) {
      const isActive = button === activeButton;
      button.classList.toggle('is-active', isActive);
      button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
    });
  }

  function filterProjects(filterValue) {
    let visibleCount = 0;
    let shownInAll = 0;

    cards.forEach(function (card) {
      const sector = card.getAttribute('data-sector');
      let shouldShow = false;

      if (filterValue === 'all') {
        if (shownInAll < MAX_ALL_CARDS) {
          shouldShow = true;
          shownInAll += 1;
        }
      } else {
        shouldShow = sector === filterValue;
      }

      card.classList.toggle('is-hidden', !shouldShow);

      if (shouldShow) {
        visibleCount += 1;
      }
    });

    countElement.textContent = visibleCount;
    updateEmptyState(visibleCount);

    if (footer) {
      footer.style.display = visibleCount > 0 ? 'flex' : 'none';
    }
  }

  filterButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      setActiveButton(button);
      filterProjects(button.getAttribute('data-filter'));
    });
  });

  filterProjects('all');
});
</script>

<?php include (__DIR__ . '/../includes/footer.php'); ?>
<?php include(__DIR__ . '/../includes/bottombar.php'); ?>
