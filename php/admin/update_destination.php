<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
    header('location: ../../index.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    // Read the JSON file
    $file = file_get_contents("../../json/data/destinations.json");
    $destinations = json_decode($file, true);

    if ($action === 'update') {
        $original_name = $_POST['original_name'];
        $new_name = $_POST['name'];
        
        // Create new data array
        $new_data = [
            'id' => $destinations[$original_name]['id'],
            'name' => $new_name,
            'galaxy' => $_POST['galaxy'],
            'description' => $_POST['description'],
            'distance' => (int)$_POST['distance'],
            'revenue' => (int)$_POST['revenue'],
            'trips' => (int)$_POST['trips'],
            'image' => $destinations[$original_name]['image'] // preserve image
        ];
    
        // Create new destinations array
        $updated_destinations = [];
        foreach ($destinations as $name => $destination) {
            if ($name === $original_name) {
                if ($original_name !== $new_name) {
                    // If name changed, create new key
                    $updated_destinations[$new_name] = $new_data;
                } else {
                    // If name unchanged, keep same key
                    $updated_destinations[$name] = $new_data;
                }
            } else {
                $updated_destinations[$name] = $destination;
            }
        }

        // Save the changes back to the JSON file
        file_put_contents("../../json/data/destinations.json", json_encode($updated_destinations, JSON_PRETTY_PRINT));
        
        header("Location: destinations.php");
        exit();
    }
    
    if ($action === 'delete') {
        $name_to_delete = $_POST['original_name'];
        
        // Remove the destination
        if (isset($destinations[$name_to_delete])) {
            unset($destinations[$name_to_delete]);
        }
        
        // Save back to file
        file_put_contents("../../json/data/destinations.json", json_encode($destinations, JSON_PRETTY_PRINT));
        
        header('Location: destinations.php');
        exit();
    }
}

header("Location: destinations.php");
exit();