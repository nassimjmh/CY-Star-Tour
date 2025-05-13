
document.getElementById('upload-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const fileInput = document.getElementById('file-input');
    const loader = document.getElementById('profile-loader');
    const errorDiv = document.getElementById('error-message');
    const imgProfile = document.getElementById('profile-pic');

    errorDiv.textContent = '';

    const file = fileInput.files[0];
    if (!file) {
        errorDiv.textContent = "Please select an image.";
        return;
    }

    const formData = new FormData();
    formData.append('profile_pic', file);

    loader.style.display = 'block';

    fetch('upload_profilepicture.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            loader.style.display = 'none';

            if (data.success) {
                imgProfile.src = data.new_path + '?v=' + new Date().getTime(); // Pour forcer la mise à jour
            } else {
                errorDiv.textContent = data.message || 'An error occurred.';
            }
        })
        .catch(error => {
            loader.style.display = 'none';
            errorDiv.textContent = "Upload failed.";
            console.error(error);
        });
});
