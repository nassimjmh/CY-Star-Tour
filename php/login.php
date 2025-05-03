<?php
session_start();

$file = '../json/data/users.json';
$users = json_decode(file_get_contents($file), true);
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

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
            <label><input type="checkbox">Remember Me</label>
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

<style>
    #errorBox {
        display: none;
        background: linear-gradient(145deg, #1e1e2f, #2c2c3f);
        border: 1px solid #ff4d4d;
        color: #ffcccc;
        padding: 14px 20px;
        border-radius: 12px;
        margin-top: 15px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 0 15px rgba(255, 77, 77, 0.4);
        animation: pulseGlow 2.5s infinite ease-in-out;
    }

    #errorBox::before {
        content: "⚠️ ";
        color: #ff4d4d;
        font-weight: bold;
    }

    @keyframes pulseGlow {
        0% { box-shadow: 0 0 10px rgba(255, 77, 77, 0.2); }
        50% { box-shadow: 0 0 20px rgba(255, 77, 77, 0.5); }
        100% { box-shadow: 0 0 10px rgba(255, 77, 77, 0.2); }
    }
</style>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const lockIcon = document.getElementById('lockIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            lockIcon.classList.replace('bxs-lock-alt', 'bxs-lock-open');
        } else {
            passwordInput.type = 'password';
            lockIcon.classList.replace('bxs-lock-open', 'bxs-lock-alt');
        }
    }

    function showErrors(errors) {
        const errorBox = document.getElementById("errorBox");
        if (errors.length > 0) {
            errorBox.innerHTML = errors.join("<br>");
            errorBox.style.display = "block";
        } else {
            errorBox.innerHTML = "";
            errorBox.style.display = "none";
        }
    }

    document.getElementById("loginForm").addEventListener("submit", function (e) {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const errors = [];

        if (!email.trim() || !password.trim()) {
            errors.push("All fields must be filled.");
        }

        if (errors.length > 0) {
            e.preventDefault();
            showErrors(errors);
        } else {
            showErrors([]);
        }
    });
</script>

</body>
</html>
