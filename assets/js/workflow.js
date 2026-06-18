/* =====================================
   WORKFLOW — POPUPS INTERATIVOS
   ===================================== */

document.addEventListener('DOMContentLoaded', () => {
    const triggers = document.querySelectorAll('.wf-dot, .btn-workflow');
    const popups = document.querySelectorAll('.popup-overlay');
    const closes = document.querySelectorAll('.close-popup');

    // === Abrir pop-up correto ao clicar ===
    triggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const step = trigger.dataset.target || trigger.dataset.step;
            const popup = document.getElementById(step);
            if (popup) {
                popup.classList.add('active');
                popup.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden'; // Evita scroll ao fundo
            }
        });
    });

    // === Fechar pop-up ao clicar no X ===
    closes.forEach(close => {
        close.addEventListener('click', () => {
            const popup = close.closest('.popup-overlay');
            popup.classList.remove('active');
            popup.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        });
    });

    // === Fechar ao clicar fora ===
    popups.forEach(popup => {
        popup.addEventListener('click', e => {
            if (e.target === popup) {
                popup.classList.remove('active');
                popup.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        });
    });

    // === Fechar com tecla ESC ===
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' || e.key === 'Esc') {
            popups.forEach(p => {
                p.classList.remove('active');
                p.setAttribute('aria-hidden', 'true');
            });
            document.body.style.overflow = '';
        }
    });
});
