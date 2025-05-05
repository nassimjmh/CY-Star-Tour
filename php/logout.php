<?php
session_start();
setcookie('remember_token', '', time() - 3600, "/");

// Supprimer aussi le token dans le fichier JSON
$file = '../json/data/users.json';
$users = json_decode(file_get_contents($file), true);

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    if (isset($users[$email]['remember_token'])) {
        $users[$email]['remember_token'] = null;
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
    }
}

session_unset();
session_destroy();
header('Location: login.php');
exit();

?>
