<?php
session_start();



$file = '../json/data/users.json';
$users = json_decode(file_get_contents($file), true);
$error = "";

//cookies

if (!isset($_SESSION['email']) && isset($_COOKIE['remember_token'])) {
    foreach ($users as $email => $userData) {
        if (isset($userData['remember_token']) && $userData['remember_token'] === $_COOKIE['remember_token']) {
            $_SESSION['email'] = $email;
            $_SESSION["first_name"] = $userData["first_name"];
            $_SESSION["role"] = $userData["role"];
            $_SESSION["last_name"] = $userData["last_name"];
            $_SESSION["race"] = $userData["race"];
            $_SESSION["date_picker"] = $userData["date_picker"];
            $_SESSION["profile_pic"] = $userData["profile_pic"];
            $_SESSION["user_id"] = $userData["id"];
            header('Location: profil.php');
            exit();
        }
    }
}






if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';



    if (isset($_POST['remember_me'])) {
        // Génère un token sécurisé
        $token = bin2hex(random_bytes(16));

        // Sauvegarde le token côté client dans un cookie
        setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), "/");

        // Mets à jour le fichier JSON
        $users[$email]['remember_token'] = $token;
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
    }



    if (isset($users[$email])) {
        if ($users[$email]['role'] === 'Banned') {
            $error = "Sorry, your account has been banned. (Contact: support@startour.cy)";
        } elseif (password_verify($password, $users[$email]['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION["first_name"] = $users[$email]["first_name"];
            $_SESSION["role"] = $users[$email]["role"];
            $_SESSION["last_name"] = $users[$email]["last_name"];
            $_SESSION["race"] = $users[$email]["race"];
            $_SESSION["date_picker"] = $users[$email]["date_picker"];
            $_SESSION["profile_pic"] = $users[$email]["profile_pic"];
            $_SESSION["user_id"] = $users[$email]["id"];
            header('Location: profil.php');
            exit();
        } else {
            $error = "Wrong email or password.";
        }
    } else {
        $error = "No account registered with this email.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StarTour - Login</title>
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="loginmenu">

<header><?php include("navbar.php") ?></header>

<div class="wrapper">
    <form action="" method="POST" id="loginForm">
        <h1>Login <a href="../index.html"><i class='bx bx-undo'></i></a></h1>

        <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Mail address">
            <i class='bx bx-envelope'></i>
        </div>

        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Password">
            <i class='bx bxs-lock-alt' id="lockIcon" onclick="togglePasswordVisibility()"></i>
        </div>

        <div class="remember-forgot">
            <label><input type="checkbox" name="remember_me">Remember Me</label>
            <a href="#">Forgot Password</a>
        </div>

        <button type="submit" class="btn">Login</button>

        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>

        <div id="errorBox" class="error-message" style="<?php echo !empty($error) ? 'display:block;' : 'display:none;'; ?>">
            <?php if (!empty($error)) : ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </div>
    </form>
</div>


<script src="../js/login.js"></script>

</body>
</html>
