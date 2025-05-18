document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('tbody').addEventListener('click', function(event) {
        if (event.target.classList.contains('action-button')) {
            event.preventDefault(); // Empecher de refresh
            
            const button = event.target;
            const action = button.value; // make_vip / remove_vip ....
            const parentDiv = button.parentElement;
            const email = parentDiv.querySelector('input[name="email"]').value;
            
            // Gerer chaque action
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

function updateUserRole(email, newRole) {
    const updateData = {
        action: 'update_role',
        email: email,
        new_role: newRole
    };
    
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
            // Refresh la page
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