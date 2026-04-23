// header.js — overlay menu control for the main header

document.addEventListener("DOMContentLoaded", () => {
  const menuOverlay = document.getElementById("menuOverlay");
  const menuToggle = document.getElementById("menuToggle");
  const menuClose = document.getElementById("menuClose");
  const darkToggle = document.querySelector(".darkmode-toggle");
  const langButtons = document.querySelectorAll(".menu-controls button");
  const accordionColumns = document.querySelectorAll(".menu-column--accordion");

  if (!menuOverlay || !menuToggle || !menuClose) {
    return;
  }

  const mobileQuery = window.matchMedia("(max-width: 768px)");

  const openMenu = () => {
    menuOverlay.classList.remove("hidden");
    menuOverlay.setAttribute("aria-hidden", "false");
    menuToggle.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  };

  const closeMenu = () => {
    menuOverlay.classList.add("hidden");
    menuOverlay.setAttribute("aria-hidden", "true");
    menuToggle.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  };

  const resetAccordionState = () => {
    if (!mobileQuery.matches) {
      accordionColumns.forEach((column) => {
        const toggle = column.querySelector(".menu-section-toggle");
        column.classList.remove("is-open");
        toggle?.setAttribute("aria-expanded", "true");
      });
    } else {
      accordionColumns.forEach((column, index) => {
        const toggle = column.querySelector(".menu-section-toggle");
        const shouldOpen = index === 0;
        column.classList.toggle("is-open", shouldOpen);
        toggle?.setAttribute("aria-expanded", shouldOpen ? "true" : "false");
      });
    }
  };

  menuToggle.addEventListener("click", openMenu);
  menuClose.addEventListener("click", closeMenu);

  menuOverlay.addEventListener("click", (event) => {
    if (event.target === menuOverlay) {
      closeMenu();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && !menuOverlay.classList.contains("hidden")) {
      closeMenu();
    }
  });

  accordionColumns.forEach((column) => {
    const toggle = column.querySelector(".menu-section-toggle");
    if (!toggle) return;

    toggle.addEventListener("click", () => {
      if (!mobileQuery.matches) return;

      const isOpen = column.classList.contains("is-open");

      accordionColumns.forEach((item) => {
        item.classList.remove("is-open");
        item.querySelector(".menu-section-toggle")?.setAttribute("aria-expanded", "false");
      });

      if (!isOpen) {
        column.classList.add("is-open");
        toggle.setAttribute("aria-expanded", "true");
      }
    });
  });

  resetAccordionState();
  mobileQuery.addEventListener("change", resetAccordionState);

  darkToggle?.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
  });

  langButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const lang = button.textContent.trim();
      console.log(`Language switched to: ${lang}`);
    });
  });
});