<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
    header('location: ../../index.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $action = $_POST['action'];
    $current_role = $_POST['current_role'];

    // Read the JSON file
    $file = file_get_contents("../users.json");
    $users = json_decode($file, true);

    if (isset($users[$email])) {
        switch($action) {
            case 'make_vip':
                $users[$email]['role'] = 'VIP';
                break;
            case 'remove_vip':
                $users[$email]['role'] = 'Standard';
                break;
            case 'ban':
                $users[$email]['role'] = 'Banned';
                break;
            case 'unban':
                $users[$email]['role'] = 'Standard';
                break;
            case 'make_admin':
                $users[$email]['role'] = 'Admin';
                break;
            case 'remove_admin':
                $users[$email]['role'] = 'Standard';
                break;
            case 'manage':
                // Redirect to a user edit page
                header("Location: edit_user.php?email=" . urlencode($email));
                exit();
                break;
        }

        // Save the changes back to the JSON file
        file_put_contents("../users.json", json_encode($users, JSON_PRETTY_PRINT));
    }

    // Redirect back to the users page
    header("Location: users.php");
    exit();
}