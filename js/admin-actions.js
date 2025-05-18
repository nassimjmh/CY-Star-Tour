document.addEventListener('DOMContentLoaded', function() {
    // Add event delegation to the tbody element
    document.querySelector('tbody').addEventListener('click', function(event) {
        // Check if the clicked element is an action button
        if (event.target.classList.contains('action-button')) {
            // Prevent default form submission that could cause page refresh
            event.preventDefault();
            
            const button = event.target;
            const action = button.value;
            const parentDiv = button.parentElement;
            const email = parentDiv.querySelector('input[name="email"]').value;
            
            // Handle different actions
            switch(action) {
                case 'make_vip':
                    updateUserRole(email, 'VIP');
                    break;
                case 'remove_vip':
                    updateUserRole(email, 'Standard');
                    break;
                case 'ban':
                    updateUserRole(email, 'Banned');
                    break;
                case 'unban':
                    updateUserRole(email, 'Standard');
                    break;
                case 'make_admin':
                    updateUserRole(email, 'Admin');
                    break;
                case 'remove_admin':
                    updateUserRole(email, 'Standard');
                    break;
                case 'manage':
                    window.location.href = `edit_user.php?email=${encodeURIComponent(email)}`;
                    break;
            }
        }
    });
});

// Simple function to update user role
function updateUserRole(email, newRole) {
    // Create JSON data - similar to profile.js
    const updateData = {
        action: 'update_role',
        email: email,
        new_role: newRole
    };
    
    // Send AJAX request with JSON data 
    fetch('users.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(updateData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Refresh just the table content, not the whole page
            fetch('users.php?ajax=true')
                .then(response => response.text())
                .then(html => {
                    document.querySelector('tbody').innerHTML = html;
                });
        } else {
            alert(data.message || 'Error updating user role');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}