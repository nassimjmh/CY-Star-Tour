const errorBox = document.getElementById("errorBox");

function showErrors(errors) {
    if (errors.length > 0) {
        errorBox.innerHTML = errors.join("<br>");
        errorBox.style.display = "block";
    } else {
        errorBox.innerHTML = "";
        errorBox.style.display = "none";
    }
}

// Mot de passe
const passwordInput = document.querySelector('[name="password"]');
const strengthBox = document.getElementById("password-strength");

passwordInput.addEventListener("input", function () {
    const password = passwordInput.value;
    const pwdLength = password.length;
    const containsNumber = /\d/.test(password);
    const containsSpecialChar = /[^a-zA-Z0-9]/.test(password);
    let passwordErrors = [];



    if (pwdLength < 3 && !containsNumber && !containsSpecialChar) {
        strengthBox.innerText = "🕳️ No security " + " " + pwdLength + " " +"space characters";
        strengthBox.style.color = "red";
    } else if (pwdLength >= 8 && containsNumber && containsSpecialChar) {
        strengthBox.innerText = "🌟 Perfect security" + " " + pwdLength + " " +"space characters";
        strengthBox.style.color = "green";
    } else {
        strengthBox.innerText = "🌌 Moderate security" + " " + pwdLength + " " +"space characters";
        strengthBox.style.color = "orange";
    }



    // Erreurs mot de passe
    if (pwdLength < 8) {
        passwordErrors.push("Password must be at least 8 characters long.");
    }
    if (!containsNumber) {
        passwordErrors.push("Password must contain a number.");
    }
    if (!containsSpecialChar) {
        passwordErrors.push("Password must contain a special character (Ex: &,*,#).");
    }

    showErrors(passwordErrors);
});

// Email
const emailInput = document.querySelector('[name="email"]');
emailInput.addEventListener("input", function () {
    const email = emailInput.value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let emailErrors = [];

    if (!emailRegex.test(email)) {
        emailErrors.push("Please enter a valid email address.");
    }

    showErrors(emailErrors);
});

// Submit global
document.getElementById("registerForm").addEventListener("submit", function (e) {
    const firstName = document.querySelector('[name="first_name"]').value.trim();
    const lastName = document.querySelector('[name="last_name"]').value.trim();
    const email = emailInput.value.trim();
    const password = passwordInput.value;
    const race = document.querySelector('[name="race"]').value;
    const date = document.querySelector('[name="date_picker"]').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let errors = [];

    if (!firstName || !lastName || !email || !password || !race || !date) {
        errors.push("All fields must be filled.");
    }

    if (errors.length > 0) {
        e.preventDefault();
        showErrors(errors);
    } else {
        showErrors([]);
    }

});
