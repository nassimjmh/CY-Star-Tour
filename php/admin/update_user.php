<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
    header('location: ../../index.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    // Read the JSON file
    $file = file_get_contents("../users.json");
    $users = json_decode($file, true);

    if ($action === 'update') {
        // Handle the edit form submission
        $original_email = $_POST['original_email'];
        $new_data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            'race' => $_POST['race'],
            'date_picker' => $_POST['date_picker']
        ];

        // Find and update the user
        $updated_users = [];
        foreach ($users as $user) {
            if ($user['email'] === $original_email) {
                // Preserve any other existing fields
                $new_data = array_merge($user, $new_data);
                $updated_users[] = $new_data;
            } else {
                $updated_users[] = $user;
            }
        }

        // Save the changes back to the JSON file
        file_put_contents("../users.json", json_encode($updated_users, JSON_PRETTY_PRINT));
        
        header("Location: users.php");
        exit();
    } else {
        // Handle other actions (make_vip, ban, etc.)
        $email = $_POST['email'];
        
        // Find and update the user
        foreach ($users as &$user) {
            if ($user['email'] === $email) {
                switch($action) {
                    case 'make_vip':
                        $user['role'] = 'VIP';
                        break;
                    case 'remove_vip':
                        $user['role'] = 'Standard';
                        break;
                    case 'ban':
                        $user['role'] = 'Banned';
                        break;
                    case 'unban':
                        $user['role'] = 'Standard';
                        break;
                    case 'make_admin':
                        $user['role'] = 'Admin';
                        break;
                    case 'remove_admin':
                        $user['role'] = 'Standard';
                        break;
                    case 'manage':
                        header("Location: edit_user.php?email=" . urlencode($email));
                        exit();
                        break;
                }
                break;
            }
        }

        // Save the changes back to the JSON file
        file_put_contents("../users.json", json_encode($users, JSON_PRETTY_PRINT));
        
        header("Location: users.php");
        exit();
    }
}