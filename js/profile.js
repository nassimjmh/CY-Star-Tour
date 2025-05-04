document.addEventListener("DOMContentLoaded", function () { //script runs only after the HTML document has been fully loaded
    const editBtn = document.getElementById("edit-btn");
    const saveBtn = document.getElementById("save-btn");
    const profileInfo = document.getElementById("profile-info");

    editBtn.addEventListener("click", function () { // When Edit button is clicked
        profileInfo.querySelectorAll("span").forEach(span => {
            const input = document.createElement("input");
            input.type = span.id === "birth-date" ? "date" : "text"; // Use date input for birth date
            input.value = span.id === "birth-date" ? formatDateForInput(span.textContent) : span.textContent;
            input.id = span.id;
            span.replaceWith(input);
        });

        // Toggle button visibility
        editBtn.style.display = "none";
        saveBtn.style.display = "inline-block";
    });



  // ????????????
  
  
    saveBtn.addEventListener("click", function () { // When Save button is clicked
        profileInfo.querySelectorAll("input").forEach(input => {
            const span = document.createElement("span");
            span.id = input.id;
            span.textContent = input.id === "birth-date" ? formatDateForDisplay(input.value) : input.value;
            input.replaceWith(span);
        });


        // AJAX
        const updatedData = {
            first_name: document.getElementById("first-name").textContent,
            last_name: document.getElementById("last-name").textContent,
            email: document.getElementById("email").textContent,
            date_picker: document.getElementById("birth-date").textContent,
            race: document.getElementById("race").textContent
        };

        fetch("update_profile.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(updatedData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Profile updated successfully!");
            } else {
                alert("Error updating profile.");
            }
        });

        // Toggle button visibility
        saveBtn.style.display = "none";
        editBtn.style.display = "inline-block";
    });

    // Helper Functions for Date Formatting
    function formatDateForInput(date) {
        const [day, month, year] = date.split("/");
        return `${year}-${month}-${day}`;
    }

    function formatDateForDisplay(date) {
        const [year, month, day] = date.split("-");
        return `${day}/${month}/${year}`;
    } 
});