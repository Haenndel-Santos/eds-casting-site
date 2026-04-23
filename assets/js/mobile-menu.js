document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.getElementById('hamburgerBtn');
    const mobileNav = document.getElementById('mobileNav');
    const submenuToggles = document.querySelectorAll('.submenu-toggle');

    if (hamburger && mobileNav) {
        hamburger.addEventListener('click', () => {
            mobileNav.classList.toggle('active');
        });
    }

    submenuToggles.forEach(button => {
        button.addEventListener('click', () => {
            const submenu = button.nextElementSibling;
            submenu.classList.toggle('open');
            button.classList.toggle('rotated');
        });
    });
});
