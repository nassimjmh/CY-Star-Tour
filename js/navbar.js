// Fonction pour définir un cookie
function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Fonction pour obtenir un cookie img
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length);
    }
    return null;
}

const button = document.getElementById('theme-toggle');
const darkMode = getCookie('darkMode');

// Appliquer le thème selon le cookie + icône
if (darkMode === 'enabled') {
    document.body.classList.add('dark');
    button.textContent = '☀️'; // soleil pour indiquer qu'on est en sombre
} else {
    button.textContent = '🌑'; // lune pour indiquer qu'on est en clair
}

// Changement de thème + icône au clic
button.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    if (document.body.classList.contains('dark')) {
        setCookie('darkMode', 'enabled', 365);
        button.textContent = '☀️';
    } else {
        setCookie('darkMode', 'disabled', 365);
        button.textContent = '🌑';
    }
});

// Gestion de l'affichage du panier
const cartContainer = document.querySelector('.cart-container');
const dropdownCart = document.querySelector('.dropdown-cart');

cartContainer.addEventListener('click', (event) => {
    event.stopPropagation(); // Empêche la propagation de l'événement de clic
    dropdownCart.classList.toggle('active');
});

document.addEventListener('click', (event) => {
    if (!cartContainer.contains(event.target)) {
        dropdownCart.classList.remove('active');
    }
});


// delete reservation from cart


function removeBooking(reservationId, event) {
    event.preventDefault(); // empêche le lien parent d'être suivi

    if (confirm("Are you sure you want to remove this booking?")) {
        fetch(`remove_booking.php?id=${encodeURIComponent(reservationId)}`, {
            method: "GET",
            credentials: "same-origin"
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recharge la page ou supprime l'élément du DOM
                    location.reload();
                } else {
                    alert("Error: " + data.message);
                }
            });
    }
}
