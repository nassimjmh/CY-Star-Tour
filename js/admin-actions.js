document.addEventListener("DOMContentLoaded", function () {
    const actionButtons = document.querySelectorAll(".action-button");

    actionButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            // Disable the button and show a loading indicator
            button.disabled = true;
            const oldValue = button.value; // Use the value attribute
            button.textContent = "Processing...";

            setTimeout(() => {
                button.disabled = false;

                // Toggle the button value and text based on the current action
                if (oldValue === "make_vip") {
                    button.value = "remove_vip";
                    button.textContent = "Remove VIP";
                } else if (oldValue === "remove_vip") {
                    button.value = "make_vip";
                    button.textContent = "Make VIP";
                } else if (oldValue === "ban") {
                    button.value = "unban";
                    button.textContent = "Unban User";
                } else if (oldValue === "unban") {
                    button.value = "ban";
                    button.textContent = "Ban User";
                } else if (oldValue === "make_admin") {
                    button.value = "remove_admin";
                    button.textContent = "Remove Admin";
                } else if (oldValue === "remove_admin") {
                    button.value = "make_admin";
                    button.textContent = "Make Admin";
                } else {
                    button.textContent = "Action Failed"; // Error
                }
            }, 3000); // 3 seconds delay
        });
    });
});