function loadReservations() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "reservations.php?ajax=true", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.querySelector("tbody").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

document.addEventListener("DOMContentLoaded", function () {
    loadReservations();
});
