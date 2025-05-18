function loadDestinations() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "destinations.php?ajax=true", true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.querySelector("tbody").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

document.addEventListener("DOMContentLoaded", function () {
    loadDestinations();
    
    // Reload destinations data every 5 seconds
    setInterval(loadDestinations, 5000);
});
