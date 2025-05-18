
function loadUsers() {
    const xhr = new XMLHttpRequest(); // ASYNC
    xhr.open("GET", "users.php?ajax=true", true);
    xhr.onload = function () {
        if (xhr.status === 200) { // Request reussie
            document.querySelector("tbody").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

document.addEventListener("DOMContentLoaded", function () {
    loadUsers();
});


