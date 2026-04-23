/* EDS – HERO Carousel Controller
 * Hooked to markup classes:
 *  - .hero-slide (each slide wrapper)
 *  - .hero-dot[data-index]
 *  - .hero-nav[data-action="prev|next"]
 *  - .hero-carousel (root container)
 */
(function () {
    const root = document.querySelector('.hero-carousel');
    if (!root) return;

    const slides = Array.from(root.querySelectorAll('.hero-slide'));
    const dots = Array.from(root.querySelectorAll('.hero-dot'));
    const prevBtn = root.querySelector('.hero-nav.prev');
    const nextBtn = root.querySelector('.hero-nav.next');

    if (slides.length === 0) return;

    let current = Math.max(0, slides.findIndex(slide => slide.classList.contains('active')));
    if (current < 0) current = 0;

    const INTERVAL = 6000;
    let timer = null;

    function isMobile() {
        return window.innerWidth <= 768;
    }

    function goTo(index) {
        current = (index + slides.length) % slides.length;

        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === current);
        });

        dots.forEach((dot, i) => {
            const isActive = i === current;
            dot.classList.toggle('active', isActive);
            dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
    }

    function next() {
        goTo(current + 1);
    }

    function prev() {
        goTo(current - 1);
    }

    function stop() {
        if (timer) {
            clearInterval(timer);
            timer = null;
        }
    }

    function start() {
        stop();

        if (isMobile()) {
            timer = setInterval(next, INTERVAL);
        }
    }

    // Dots click
    dots.forEach(dot => {
        dot.addEventListener('click', (event) => {
            const idx = parseInt(event.currentTarget.getAttribute('data-index'), 10) || 0;
            goTo(idx);
            start();
        });
    });

    // Arrows
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            next();
            start();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prev();
            start();
        });
    }

    // Pause only when autoplay is active (mobile)
    root.addEventListener('mouseenter', () => {
        if (isMobile()) stop();
    });

    root.addEventListener('mouseleave', () => {
        if (isMobile()) start();
    });

    root.addEventListener('focusin', () => {
        if (isMobile()) stop();
    });

    root.addEventListener('focusout', () => {
        if (isMobile()) start();
    });

    // Keyboard support
    root.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowRight') {
            next();
            start();
        }

        if (event.key === 'ArrowLeft') {
            prev();
            start();
        }
    });

    // Re-evaluate on resize
    window.addEventListener('resize', start);

    // Init
    goTo(current);
    start();
})();