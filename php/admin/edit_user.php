<?php
session_start();

// Check admin access
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
    header('location: ../../index.html');
    exit();
}

// Initialize $userData
$userData = null;

// Check if we have either POST or GET email parameter
if (isset($_POST['email']) || isset($_GET['email'])) {
    $file = file_get_contents("../users.json");
    $users = json_decode($file, true);
    $userEmail = isset($_POST['email']) ? $_POST['email'] : $_GET['email'];

    // Find the user data
    foreach ($users as $user) {
        if ($user['email'] === $userEmail) {
            $userData = $user;
            break;
        }
    }
}

// Redirect if no valid user data found
if (!$userData) {
    header('location: users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - StarTour Admin</title>
    <link rel="icon" href="../../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="dashboard">
<?php include("bars.php") ?>

<div class="edit-user-panel">
    <div class="user-form-container">
        <section>
            <form method="POST" action="update_user.php" class="edit-form">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="original_email" value="<?php echo htmlspecialchars($userData['email']); ?>">
                
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($userData['first_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($userData['last_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="Standard" <?php echo $userData['role'] === 'Standard' ? 'selected' : ''; ?>>Standard</option>
                        <option value="VIP" <?php echo $userData['role'] === 'VIP' ? 'selected' : ''; ?>>VIP</option>
                        <option value="Admin" <?php echo $userData['role'] === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="Banned" <?php echo $userData['role'] === 'Banned' ? 'selected' : ''; ?>>Banned</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="race">Race:</label>
                    <select id="race" name="race" required>
                        <option value="human" <?php echo $userData['race'] === 'human' ? 'selected' : ''; ?>>Human</option>
                        <option value="ia" <?php echo $userData['race'] === 'ia' ? 'selected' : ''; ?>>IA</option>
                        <option value="alien" <?php echo $userData['race'] === 'alien' ? 'selected' : ''; ?>>Alien</option>
                        <option value="coruscant" <?php echo $userData['race'] === 'coruscant' ? 'selected' : ''; ?>>Coruscant</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_picker">Date of Birth:</label>
                    <input type="date" id="date_picker" name="date_picker" value="<?php echo htmlspecialchars($userData['date_picker']); ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-button">Save Changes</button>
                    <a href="users.php" class="cancel-button">Cancel</a>
                </div>
            </form>
        </section>
    </div>
</div>

</body>
</html>