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
});
