function toggleDarkMode() { 
  const isDark = document.body.classList.toggle('dark-mode');
  localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
  updateLogoImage(isDark);
}

function updateLogoImage(isDark) {
  const logo = document.querySelector('.logo-header');
  const footerLogo = document.getElementById('footer-logo');

  if (logo) {
    logo.src = isDark 
      ? '/dev/assets/img/logo/logo-main-white.png' 
      : '/dev/assets/img/logo/logo-main.png';
  }

  if (footerLogo) {
    footerLogo.src = isDark 
      ? '/dev/assets/img/logo/logo-main-white.png' 
      : '/dev/assets/img/logo/logo-main.png';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // ✅ Proteção extra para evitar erro
  if (typeof currentLang !== 'undefined') {
    loadLanguage(currentLang);
  }

  const savedMode = localStorage.getItem('darkMode');
  const isDark = savedMode === 'enabled';

  if (isDark) {
    document.body.classList.add('dark-mode');
  }

  updateLogoImage(isDark);

  const toggleBtn = document.getElementById('toggle-dark');
  if (toggleBtn) {
    toggleBtn.addEventListener('click', toggleDarkMode);
  }
});
