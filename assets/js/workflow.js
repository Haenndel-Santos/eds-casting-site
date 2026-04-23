/* =====================================
   WORKFLOW — POPUPS INTERATIVOS
   ===================================== */

document.addEventListener('DOMContentLoaded', () => {
    const dots = document.querySelectorAll('.wf-dot');
    const popups = document.querySelectorAll('.popup-overlay');
    const closes = document.querySelectorAll('.close-popup');

    // === Abrir pop-up correto ao clicar ===
    dots.forEach(dot => {
        dot.addEventListener('click', () => {
            const step = dot.dataset.target || dot.dataset.step;
            const popup = document.getElementById(step);
            if (popup) {
                popup.classList.add('active');
                document.body.style.overflow = 'hidden'; // Evita scroll ao fundo
            }
        });
    });

    // === Fechar pop-up ao clicar no X ===
    closes.forEach(close => {
        close.addEventListener('click', () => {
            const popup = close.closest('.popup-overlay');
            popup.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // === Fechar ao clicar fora ===
    popups.forEach(popup => {
        popup.addEventListener('click', e => {
            if (e.target === popup) {
                popup.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // === Fechar com tecla ESC ===
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' || e.key === 'Esc') {
            popups.forEach(p => p.classList.remove('active'));
            document.body.style.overflow = '';
        }
    });
});
