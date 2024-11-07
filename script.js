// Controleer of de gebruiker al cookies heeft geaccepteerd
window.onload = function() {
    if (!getCookie("cookiesAccepted")) {
        document.getElementById("cookie-banner").style.display = "block";
    }
};

// Functie om de cookie op te slaan
document.getElementById("accept-cookies").addEventListener("click", function() {
    setCookie("cookiesAccepted", "true", 365); // Cookie blijft 365 dagen geldig
    document.getElementById("cookie-banner").style.display = "none";
});

// Functie om een cookie in te stellen
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// Functie om een cookie op te halen
function getCookie(name) {
    const nameEQ = name + "=";
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let c = cookies[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}