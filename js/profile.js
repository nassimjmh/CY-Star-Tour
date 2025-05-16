document.addEventListener("DOMContentLoaded", function () { //script runs only after the HTML document has been fully loaded
    const editBtn = document.getElementById("edit-btn");
    const saveBtn = document.getElementById("save-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const profileInfo = document.getElementById("profile-info");

    editBtn.addEventListener("click", function () { // When Edit button is clicked
        profileInfo.querySelectorAll("span").forEach(span => {
            const input = document.createElement("input");
            input.type = span.id === "birth-date" ? "date" : "text"; // Use date input for birth date and text for the others
            input.value = span.textContent;
            input.id = span.id;

            input.dataset.originalValue = span.textContent; // Dom to store original data

            span.replaceWith(input); // become an input
        });

        // Toggle button visibility
        editBtn.style.display = "none";
        cancelBtn.style.display = "inline-block";
        saveBtn.style.display = "inline-block";
    });


    saveBtn.addEventListener("click", function () { // When Save button is clicked
        profileInfo.querySelectorAll("input").forEach(input => {
            const span = document.createElement("span");
            span.id = input.id;
            span.textContent = input.value;
            input.replaceWith(span); // Is no longer an input
        });


       const updatedData = {
            first_name: document.getElementById("first-name").textContent,
            last_name: document.getElementById("last-name").textContent,
            email: document.getElementById("email").textContent,
            date_picker: document.getElementById("birth-date").textContent,
        }; 

        fetch("profil.php", { // Send information to server
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(updatedData)
        });

        // Toggle button visibility
        saveBtn.style.display = "none";
        cancelBtn.style.display = "none";
        editBtn.style.display = "inline-block";
    });

    cancelBtn.addEventListener("click",function() { // When cancel button is clicked
        profileInfo.querySelectorAll("input").forEach(input => {
            const span = document.createElement("span");
            span.id = input.id;
            span.textContent = input.value;

            span.textContent = input.dataset.originalValue; // Keep original value

            input.replaceWith(span); // Is no longer an input
        });

        saveBtn.style.display = "none";
        cancelBtn.style.display = "none";
        editBtn.style.display = "inline-block";

    });
});






//POP UP


function showModal(event) {
    event.preventDefault();
    document.getElementById('roleModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('roleModal').style.display = 'none';
}

function outsideClick(event) {
    const modal = document.getElementById('roleModal');
    const content = document.querySelector('.modal-content');
    if (!content.contains(event.target)) {
        closeModal();
    }
}
