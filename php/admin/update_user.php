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
        $original_email = $_POST['original_email'];
        $new_email = $_POST['email'];
        
        // Create new data array preserving the nested structure
        $new_data = [
            'id' => $users[$original_email]['id'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $new_email,
            'password' => $users[$original_email]['password'], // preserve password
            'role' => $_POST['role'],
            'race' => $_POST['race'],
            'date_picker' => $_POST['date_picker'],
            'profile_pic' => $users[$original_email]['profile_pic'] // preserve profile pic
        ];
    
        // Create new users array
        $updated_users = [];
        foreach ($users as $email => $user) {
            if ($email === $original_email) {
                if ($original_email !== $new_email) {
                    // If email changed, create new key
                    $updated_users[$new_email] = $new_data;
                } else {
                    // If email unchanged, keep same key
                    $updated_users[$email] = $new_data;
                }
            } else {
                $updated_users[$email] = $user;
            }
        }

        // Save the changes back to the JSON file
        file_put_contents("../users.json", json_encode($updated_users, JSON_PRETTY_PRINT));
        
        header("Location: users.php");
        exit();
    }if ($_POST['action'] === 'delete') {
        $file = file_get_contents("../users.json");
        $users = json_decode($file, true);
        
        // Get the email to delete
        $email_to_delete = $_POST['original_email'];
        
        // Simply remove the user by their email key
        if (isset($users[$email_to_delete])) {
            unset($users[$email_to_delete]);
        }
        
        // Save back to file (without array_values)
        file_put_contents("../users.json", json_encode($users, JSON_PRETTY_PRINT));
        
        header('Location: users.php');
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