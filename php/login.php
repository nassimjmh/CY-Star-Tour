
<?php
session_start();


$file = 'users.json';
$users = json_decode(file_get_contents($file), true);
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($users[$email])) {
        if (password_verify($password, $users[$email]['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION["first_name"] = $users[$email]["first_name"];
            $_SESSION["role"] = $users[$email]["role"];
            $_SESSION["last_name"] = $users[$email]["last_name"];
            $_SESSION["race"] = $users[$email]["race"];
            $_SESSION["date_picker"] = $users[$email]["date_picker"];

            if ($users[$email]['role'] === 'Admin') {
                header('Location: profil.php');
            } else {
                header('Location: profil.php');
            }
            exit();
        } else {
            $error = "❌ Email ou mot de passe incorrect.";
        }
    } else {
        $error = "❌ Cet email n'est pas enregistré.";
    }
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarTour - Login</title>
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="loginmenu">
<header>
    <nav>
        <ul>
            <li class="logo">
                <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo" >
            </li>
            <li>
                <a class="underline" href="../index.html">Home</a>
            </li>
            <li>
                <a class="underline" href="book.html">Destinations</a>
                <ul class="submenu">
                    <li><a href="map.html">Map</a></li>
                </ul>

            </li>

            <li>
                <a class="underline" href="aboutus.html">About us</a>
            </li>
            <li class="research">
                <a href="book.html"><i class='bx bx-search research'></i></a>
            </li>
            <li class="connect">
                <a href="profil.php"><i class='bx bx-user-circle connect'></i></a>
            </li>
        </ul>
    </nav>
</header>

<div class="wrapper">
    <form action="" method="POST">
        <h1>Login <a href="../index.html"><i class='bx bx-undo'></i></a></h1>
        <div class="input-box">
            <input type="mail" name="email" placeholder="Mail address" required>
            <i class='bx bx-envelope'></i>
        </div>
        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt' ></i>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox">Remember Me</label>
            <a href="#">Forgot Password</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
            <p>Dont have an account? <a href="register.php">Register</a></p>

        </div>
        <?php if (!empty($error)) : ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

    </form>
</div>





</body>
</html>
