document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll('.quicknav-item[href^="#"], a[href^="/pages-php/about-us.php#"]');
  const yOffset = -130; // ajuste para altura do header fixo

  links.forEach(link => {
    link.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      const targetId = href.includes('#') ? href.split('#')[1] : null;
      if (!targetId) return;

      const target = document.getElementById(targetId);
      if (target) {
        e.preventDefault();
        const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo({ top: y, behavior: 'smooth' });
      }
    });
  });
});


// JavaScript para alternar entre as abas
document.querySelectorAll('.circle-tab').forEach(tab => {
tab.addEventListener('click', function() {
// Remove a classe active de todas as abas e conteúdos
document.querySelectorAll('.circle-tab').forEach(t => t.classList.remove('active'));
document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

// Adiciona a classe active à aba clicada e ao conteúdo correspondente
this.classList.add('active');
const target = this.getAttribute('data-target');
document.getElementById(target).classList.add('active');
});
});

