document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("cookie-banner");
    const acceptBtn = document.getElementById("accept-cookies");
    const declineBtn = document.getElementById("decline-cookies");

    const consent = localStorage.getItem("cookieConsent");

    // Se ainda não foi dado consentimento, mostra o banner
    if (!consent && banner) {
        banner.style.display = "block";
    }

    // Ao aceitar cookies
    if (acceptBtn) {
        acceptBtn.addEventListener("click", function () {
            localStorage.setItem("cookieConsent", "accepted");
            banner.style.display = "none";
            enableAnalytics(); // aqui você ativa scripts externos
        });
    }

    // Ao recusar cookies
    if (declineBtn) {
        declineBtn.addEventListener("click", function () {
            localStorage.setItem("cookieConsent", "declined");
            banner.style.display = "none";
        });
    }

    // Ativa GA se já foi aceito anteriormente
    if (consent === "accepted") {
        enableAnalytics();
    }

    // Função que ativa scripts permitidos (como Google Analytics)
    function enableAnalytics() {
        // Exemplo: inserir o script do Google Analytics dinamicamente
        const script = document.createElement("script");
        script.src = "https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX";
        script.async = true;
        document.head.appendChild(script);

        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag("js", new Date());
        gtag("config", "G-XXXXXXXXXX");
    }
});
