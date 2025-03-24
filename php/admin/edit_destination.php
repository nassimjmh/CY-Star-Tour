<?php
session_start();

// Check admin access
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
    header('location: ../../index.html');
    exit();
}

// Initialize $destinationData
$destinationData = null;

// Check if we have either POST or GET name parameter
if (isset($_POST['name']) || isset($_GET['name'])) {
    $file = file_get_contents("../../json/data/destinations.json");
    $destinations = json_decode($file, true);
    $destinationName = isset($_POST['name']) ? $_POST['name'] : $_GET['name'];

    // Find the destination data
    if (isset($destinations[$destinationName])) {
        $destinationData = $destinations[$destinationName];
        $destinationData['original_name'] = $destinationName; // Store original name for reference
    }
}

// Redirect if no valid destination data found
if (!$destinationData) {
    header('location: destinations.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destination - StarTour Admin</title>
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
            <form method="POST" action="update_destination.php" class="edit-form">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="original_name" value="<?php echo htmlspecialchars($destinationData['original_name']); ?>">
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($destinationData['name']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="galaxy">Galaxy:</label>
                    <input type="text" id="galaxy" name="galaxy" value="<?php echo htmlspecialchars($destinationData['galaxy']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($destinationData['description']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="distance">Distance:</label>
                    <input type="number" id="distance" name="distance" value="<?php echo htmlspecialchars($destinationData['distance']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="revenue">Revenue:</label>
                    <input type="number" id="revenue" name="revenue" value="<?php echo htmlspecialchars($destinationData['revenue']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="trips">Trips:</label>
                    <input type="number" id="trips" name="trips" value="<?php echo htmlspecialchars($destinationData['trips']); ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="save-button">Save Changes</button>
                    <a href="destinations.php" class="cancel-button">Cancel</a>
                    <button type="submit" class="delete-button" name="action" value="delete" onclick="return confirm('Are you sure you want to delete this destination?');">Delete Destination</button>
                </div>
            </form>
        </section>
    </div>
</div>

</body>
</html>