document.addEventListener("DOMContentLoaded", function () {
  const banner = document.getElementById("cookie-banner");
  const acceptAllBtn = document.getElementById("accept-all-cookies");
  const limitedBtn = document.getElementById("limited-cookies");
  const declineBtn = document.getElementById("decline-cookies");
  const storageKey = "edsCookieConsent";

  if (!banner) return;

  let consent = "";

  try {
    consent = window.localStorage.getItem(storageKey) || window.localStorage.getItem("cookieConsent") || "";
  } catch (error) {
    consent = "";
  }

  function hideBanner() {
    banner.classList.remove("open");
    banner.setAttribute("aria-hidden", "true");
  }

  function showBanner() {
    banner.classList.add("open");
    banner.setAttribute("aria-hidden", "false");
  }

  function saveConsent(value) {
    try {
      window.localStorage.setItem(storageKey, value);
      window.localStorage.setItem("cookieConsent", value);
    } catch (error) {
      /* Consent storage may be unavailable; keep the UI functional. */
    }

    hideBanner();
  }

  if (["all", "limited", "none", "accepted", "declined"].includes(consent)) {
    hideBanner();
  } else {
    showBanner();
  }

  acceptAllBtn?.addEventListener("click", function () {
    saveConsent("all");
  });

  limitedBtn?.addEventListener("click", function () {
    saveConsent("limited");
  });

  declineBtn?.addEventListener("click", function () {
    saveConsent("none");
  });
});
