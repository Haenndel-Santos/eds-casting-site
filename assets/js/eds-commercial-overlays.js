(function () {
  const openButtons = document.querySelectorAll('[data-eds-modal-open]');
  const closeSelectors = '[data-eds-modal-close]';
  let activeModal = null;
  let lastTrigger = null;

  function getFocusable(modal) {
    return Array.from(modal.querySelectorAll('a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'));
  }

  function openModal(id, trigger) {
    const modal = document.getElementById(id);
    if (!modal) return;

    activeModal = modal;
    lastTrigger = trigger || null;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('eds-info-modal-open');

    if (lastTrigger) {
      lastTrigger.setAttribute('aria-expanded', 'true');
    }

    const focusable = getFocusable(modal);
    const firstFocus = focusable[0] || modal;
    firstFocus.focus({ preventScroll: true });
  }

  function closeModal() {
    if (!activeModal) return;

    activeModal.classList.remove('is-open');
    activeModal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('eds-info-modal-open');

    if (lastTrigger) {
      lastTrigger.setAttribute('aria-expanded', 'false');
      lastTrigger.focus({ preventScroll: true });
    }

    activeModal = null;
    lastTrigger = null;
  }

  openButtons.forEach(function (button) {
    const targetId = button.getAttribute('data-eds-modal-open');
    if (!targetId) return;

    button.setAttribute('aria-expanded', 'false');
    button.addEventListener('click', function () {
      openModal(targetId, button);
    });
  });

  document.addEventListener('click', function (event) {
    if (!activeModal) return;

    if (event.target.matches(closeSelectors) || event.target === activeModal) {
      closeModal();
    }
  });

  document.addEventListener('keydown', function (event) {
    if (!activeModal) return;

    if (event.key === 'Escape') {
      closeModal();
    }
  });
})();
