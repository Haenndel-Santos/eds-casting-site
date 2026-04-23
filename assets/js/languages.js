// === File: assets/js/languages.js ===

const supportedLanguages = ['en', 'pt', 'nl', 'de', 'zh'];
let currentLang = localStorage.getItem('lang') || navigator.language.slice(0, 2);
if (!supportedLanguages.includes(currentLang)) currentLang = 'en';

function loadLanguage(lang = 'en') {
  fetch(`/assets/lang/${lang}.json`)
    .then(res => res.json())
    .then(data => {
      document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (data[key]) el.innerHTML = data[key];
      });
      localStorage.setItem('lang', lang);
    });
}

function setLanguage(lang) {
  if (supportedLanguages.includes(lang)) {
    loadLanguage(lang);
  }
}

