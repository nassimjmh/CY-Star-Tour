
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
                header('Location: admin/dashboard.php');
            } else {
                header('Location: profil.php');
            }
            exit();
        } else {
            $error = "❌ Wrong email or password";
        }
    } else {
        $error = "❌ No account registered on this email.";
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
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="loginmenu">
<header>
  <?php include("navbar.php")?>


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
