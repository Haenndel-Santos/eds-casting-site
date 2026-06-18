(function () {
  const PROJECTS_SHOW_ALL_STEP = 4;
  const COMPONENTS_SHOW_ALL_STEP = 8;

  const projectCards = Array.from(document.querySelectorAll('[data-project-card]'));
  const projectShowMoreWrap = document.querySelector('[data-project-show-more-wrap]');
  const projectShowMoreButton = document.querySelector('[data-project-show-more]');
  const projectEndCta = document.querySelector('[data-project-end-cta]');
  const projectCasesSection = document.getElementById('project-cases');

  function initProjectCards() {
    if (!projectCards.length) {
      return;
    }

    let visibleProjectLimit = PROJECTS_SHOW_ALL_STEP;

    function scrollToProjectCasesStart() {
      if (!projectCasesSection) {
        return;
      }

      const offsetTop = Math.max(0, projectCasesSection.getBoundingClientRect().top + window.scrollY - 120);
      window.scrollTo({ top: offsetTop, behavior: 'smooth' });
    }

    function scrollToProjectCard(card) {
      const offsetTop = Math.max(0, card.getBoundingClientRect().top + window.scrollY - 120);
      window.scrollTo({ top: offsetTop, behavior: 'smooth' });
    }

    function collapseProjectCard(card) {
      const toggle = card.querySelector('[data-project-toggle]');
      const details = toggle ? document.getElementById(toggle.getAttribute('aria-controls')) : null;

      if (!toggle || !details) {
        return;
      }

      details.hidden = true;
      card.classList.remove('is-expanded');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.textContent = 'Show technical details';
    }

    function applyProjectVisibility() {
      let visibleCount = 0;

      projectCards.forEach((card, index) => {
        const shouldShow = index < visibleProjectLimit;
        card.classList.toggle('is-hidden', !shouldShow);

        if (shouldShow) {
          visibleCount += 1;
        } else {
          collapseProjectCard(card);
        }
      });

      const canToggleProjects = projectCards.length > PROJECTS_SHOW_ALL_STEP;
      const hasMore = projectCards.length > visibleCount;
      const reachedEnd = canToggleProjects && !hasMore;

      if (projectShowMoreWrap) {
        projectShowMoreWrap.hidden = !canToggleProjects;
      }

      if (projectShowMoreButton) {
        projectShowMoreButton.hidden = !canToggleProjects;
        projectShowMoreButton.textContent = reachedEnd ? 'Show less' : 'Show more projects';
        projectShowMoreButton.setAttribute('data-project-action', reachedEnd ? 'less' : 'more');
      }

      if (projectEndCta) {
        projectEndCta.hidden = !reachedEnd;
      }
    }

    function revealProjectFromHash(shouldScroll) {
      const projectId = decodeURIComponent((window.location.hash || '').replace(/^#/, ''));

      if (!projectId) {
        return false;
      }

      const targetCard = projectCards.find((card) => card.id === projectId);

      if (!targetCard) {
        return false;
      }

      const targetIndex = projectCards.indexOf(targetCard);

      if (targetIndex >= visibleProjectLimit) {
        visibleProjectLimit = Math.ceil((targetIndex + 1) / PROJECTS_SHOW_ALL_STEP) * PROJECTS_SHOW_ALL_STEP;
        applyProjectVisibility();
      }

      if (shouldScroll) {
        window.requestAnimationFrame(() => scrollToProjectCard(targetCard));
      }

      return true;
    }

    if (projectShowMoreButton) {
      projectShowMoreButton.addEventListener('click', () => {
        const action = projectShowMoreButton.getAttribute('data-project-action') || 'more';

        if (action === 'less') {
          visibleProjectLimit = PROJECTS_SHOW_ALL_STEP;
          scrollToProjectCasesStart();
        } else {
          visibleProjectLimit += PROJECTS_SHOW_ALL_STEP;
        }

        applyProjectVisibility();
      });
    }

    applyProjectVisibility();
    revealProjectFromHash(true);
    window.addEventListener('hashchange', () => revealProjectFromHash(true));

    projectCards.forEach((card) => {
      const toggle = card.querySelector('[data-project-toggle]');
      const collapse = card.querySelector('[data-project-collapse]');

      if (!toggle) {
        return;
      }

      const details = document.getElementById(toggle.getAttribute('aria-controls'));

      if (!details) {
        return;
      }

      toggle.addEventListener('click', () => {
        const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
        details.hidden = isExpanded;
        card.classList.toggle('is-expanded', !isExpanded);
        toggle.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
        toggle.textContent = isExpanded ? 'Show technical details' : 'Hide technical details';
      });

      if (collapse) {
        collapse.addEventListener('click', () => {
          details.hidden = true;
          card.classList.remove('is-expanded');
          toggle.setAttribute('aria-expanded', 'false');
          toggle.textContent = 'Show technical details';
          toggle.focus({ preventScroll: true });
        });
      }
    });
  }

  function initComponentCards() {
    const componentFilterButtons = Array.from(document.querySelectorAll('[data-component-filter]'));
    const componentCards = Array.from(document.querySelectorAll('[data-component-card]'));
    const componentShowMoreWrap = document.querySelector('[data-component-show-more-wrap]');
    const componentShowMoreButton = document.querySelector('[data-component-show-more]');

    if (!componentFilterButtons.length || !componentCards.length) {
      return;
    }

    let activeComponentFilter = 'all';
    let visibleComponentLimit = COMPONENTS_SHOW_ALL_STEP;

    function setActiveComponentFilter(activeButton) {
      componentFilterButtons.forEach((button) => {
        const isActive = button === activeButton;
        button.classList.toggle('is-active', isActive);
        button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
      });
    }

    function applyComponentFilter() {
      const showAllMode = activeComponentFilter === 'all';
      let visibleCount = 0;
      let matchingCount = 0;

      componentCards.forEach((card) => {
        const matchesFilter = showAllMode || card.dataset.componentField === activeComponentFilter;

        if (matchesFilter) {
          matchingCount += 1;
        }

        const shouldShow = matchesFilter && (!showAllMode || visibleCount < visibleComponentLimit);
        card.classList.toggle('is-hidden', !shouldShow);

        if (shouldShow) {
          visibleCount += 1;
        }
      });

      const hasMore = showAllMode && matchingCount > visibleCount;

      if (componentShowMoreWrap) {
        componentShowMoreWrap.hidden = !hasMore;
      }

      if (componentShowMoreButton) {
        componentShowMoreButton.hidden = !hasMore;
      }
    }

    componentFilterButtons.forEach((button) => {
      button.addEventListener('click', () => {
        activeComponentFilter = button.dataset.componentFilter || 'all';
        visibleComponentLimit = activeComponentFilter === 'all' ? COMPONENTS_SHOW_ALL_STEP : Number.MAX_SAFE_INTEGER;
        setActiveComponentFilter(button);
        applyComponentFilter();
      });
    });

    if (componentShowMoreButton) {
      componentShowMoreButton.addEventListener('click', () => {
        visibleComponentLimit += COMPONENTS_SHOW_ALL_STEP;
        applyComponentFilter();
      });
    }

    const initialComponentButton = componentFilterButtons.find((button) => button.dataset.componentFilter === 'all');

    if (initialComponentButton) {
      activeComponentFilter = 'all';
      visibleComponentLimit = COMPONENTS_SHOW_ALL_STEP;
      setActiveComponentFilter(initialComponentButton);
      applyComponentFilter();
    }
  }

  initProjectCards();
  initComponentCards();
})();
