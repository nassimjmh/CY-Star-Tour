
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const lockIcon = document.getElementById('lockIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        lockIcon.classList.replace('bxs-lock-alt', 'bxs-lock-open');
    } else {
        passwordInput.type = 'password';
        lockIcon.classList.replace('bxs-lock-open', 'bxs-lock-alt');
    }
}

function showErrors(errors) {
    const errorBox = document.getElementById("errorBox");
    if (errors.length > 0) {
        errorBox.innerHTML = errors.join("<br>");
        errorBox.style.display = "block";
    } else {
        errorBox.innerHTML = "";
        errorBox.style.display = "none";
    }
}

document.getElementById("loginForm").addEventListener("submit", function (e) {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const errors = [];

    if (!email.trim() || !password.trim()) {
        errors.push("All fields must be filled.");
    }

    if (errors.length > 0) {
        e.preventDefault();
        showErrors(errors);
    } else {
        showErrors([]);
    }
});
