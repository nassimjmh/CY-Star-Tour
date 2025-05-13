<?php
session_start();

$response = ['success' => false, 'message' => 'An error occurred.'];

if (!isset($_SESSION['email'])) {
    $response['message'] = 'Unauthorized access.';
    echo json_encode($response);
    exit;
}

$email = $_SESSION['email'];
$users = json_decode(file_get_contents('../json/data/users.json'), true);
$target_dir = "../uploads/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
    $imageFileType = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));
    $random_string = bin2hex(random_bytes(16));
    $target_file = $target_dir . $random_string . '.' . $imageFileType;

    if ($_FILES["profile_pic"]["error"] === UPLOAD_ERR_OK) {
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check === false) {
            $response['message'] = "File is not an image.";
            echo json_encode($response);
            exit;
        }

        if ($_FILES["profile_pic"]["size"] > 500000) {
            $response['message'] = "File is too large (max 500 KB).";
            echo json_encode($response);
            exit;
        }

        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $response['message'] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            echo json_encode($response);
            exit;
        }

        // Delete old file if it exists
        if (!empty($users[$email]['profile_pic']) && file_exists($users[$email]['profile_pic'])) {
            unlink($users[$email]['profile_pic']);
        }

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $users[$email]['profile_pic'] = $target_file;
            $_SESSION['profile_pic'] = $target_file;

            file_put_contents('../json/data/users.json', json_encode($users, JSON_PRETTY_PRINT));

            $response['success'] = true;
            $response['message'] = "Profile picture updated.";
            $response['new_path'] = $target_file;
        } else {
            $response['message'] = "Error while uploading the file.";
        }
    } else {
        $response['message'] = "No file uploaded or upload error.";
    }
} else {
    $response['message'] = "Invalid request.";
}

header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
