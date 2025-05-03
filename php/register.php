<?php
session_start();

$file = '../json/data/users.json';


$users = json_decode(file_get_contents($file), true);
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $race = $_POST['race'];
    $date_picker = $_POST['date_picker'];
    $role = 'Standard';
    $card_holder="";
    $card_number="";
    $expiry_date="";
    $cvv ="";

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    if (!isset($users[$email])) {
        $existingIds = array_column($users, 'id');
        sort($existingIds);
        $nextId = 1;
        foreach ($existingIds as $id) {
            if ($id != $nextId) {
                break;
            }
            $nextId++;
        }
        $users[$email] = [
            'id' => $nextId,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $hashedPassword,
            'race' => $race,
            'date_picker' => $date_picker,
            'role' => $role,
            'profile_pic' => 'https://api.dicebear.com/9.x/pixel-art/svg?seed=n' . $first_name,
            'card_info' => [
                'card_holder' => $card_holder,
                'card_number' => $card_number,
                'expiry_date' => $expiry_date,
                'cvv' => $cvv
            ]
        ];

        $_SESSION['email'] = $email;
        $_SESSION["first_name"] = $users[$email]["first_name"];
        $_SESSION["role"] = $users[$email]["role"];
        $_SESSION["last_name"] = $users[$email]["last_name"];
        $_SESSION["race"] = $users[$email]["race"];
        $_SESSION["date_picker"] = $users[$email]["date_picker"];
        $_SESSION["profile_pic"] = $users[$email]["profile_pic"];

        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));


        header('Location: profil.php');
        exit();
    } else {
        $error = " This email is already taken. Please choose another one.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarTour - Register</title>
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/register.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>
<body id="registermenu">
<header>
    <?php include("navbar.php")?>
</header>

<div class="wrapper">
    <form method="POST" id="registerForm">
        <h1>Register</h1>
        <div class="input-box">
            <input type="text" name="first_name" placeholder="First Name">
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="text" name="last_name" placeholder="Last Name">
            <i class='bx bxs-user'></i>
        </div>

        <div class="input-box">
            <input type="email" name="email" placeholder="Email">
            <i class='bx bx-envelope'></i>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password">
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div id="password-strength" style="margin-top: 5px; font-weight: bold;"></div>

        <hr class="separator"> <!-- Separator -->
        <div class="input-box date-box">
            <label>Birth Date</label>
            <input type="date" class="date" name="date_picker" min="3900-01-01" max="<?php echo date('Y')+2000; ?>-<?php echo date('m-d'); ?>" value="<?php echo date('Y')+2000; ?>-<?php echo date('m-d'); ?>">
        </div>

        <div class="input-box">
            <label>Your Race</label>
            <select name="race">
                <option value="" disabled>Select your race</option>
                <option value="Human">Human</option>
                <option value="IA">IA</option>
                <option value="Alien">Alien</option>
                <option value="Coruscant">Coruscant</option>
            </select>
        </div>


        <button type="submit" class="btn">Register</button>
        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>



        <!-- server error -->   <!-- client error -->


        <div id="errorBox" class="error-message" style="<?php echo !empty($error) ? 'display:block;' : 'display:none;'; ?>">
            <?php if (!empty($error)) : ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
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
                content: "⚠️";
                color: #ff4d4d;
                font-weight: bold;
            }

            @keyframes pulseGlow {
                0% {
                    box-shadow: 0 0 10px rgba(255, 77, 77, 0.2);
                }
                50% {
                    box-shadow: 0 0 20px rgba(255, 77, 77, 0.5);
                }
                100% {
                    box-shadow: 0 0 10px rgba(255, 77, 77, 0.2);
                }
            }
        </style>
    </form>
</div>


<script>
    const errorBox = document.getElementById("errorBox");

    function showErrors(errors) {
        if (errors.length > 0) {
            errorBox.innerHTML = errors.join("<br>");
            errorBox.style.display = "block";
        } else {
            errorBox.innerHTML = "";
            errorBox.style.display = "none";
        }
    }

    // Mot de passe
    const passwordInput = document.querySelector('[name="password"]');
    const strengthBox = document.getElementById("password-strength");

    passwordInput.addEventListener("input", function () {
        const password = passwordInput.value;
        const pwdLength = password.length;
        const containsNumber = /\d/.test(password);
        const containsSpecialChar = /[^a-zA-Z0-9]/.test(password);
        let passwordErrors = [];



        if (pwdLength < 3 && !containsNumber && !containsSpecialChar) {
            strengthBox.innerText = "🕳️ No security " + " " + pwdLength + " " +"space characters";
            strengthBox.style.color = "red";
        } else if (pwdLength >= 8 && containsNumber && containsSpecialChar) {
            strengthBox.innerText = "🌟 Perfect security" + " " + pwdLength + " " +"space characters";
            strengthBox.style.color = "green";
        } else {
            strengthBox.innerText = "🌌 Moderate security" + " " + pwdLength + " " +"space characters";
            strengthBox.style.color = "orange";
        }



        // Erreurs mot de passe
        if (pwdLength < 8) {
            passwordErrors.push("Password must be at least 8 characters long.");
        }
        if (!containsNumber) {
            passwordErrors.push("Password must contain a number.");
        }
        if (!containsSpecialChar) {
            passwordErrors.push("Password must contain a special character (Ex: &,*,#).");
        }

        showErrors(passwordErrors);
    });

    // Email
    const emailInput = document.querySelector('[name="email"]');
    emailInput.addEventListener("input", function () {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let emailErrors = [];

        if (!emailRegex.test(email)) {
            emailErrors.push("Please enter a valid email address.");
        }

        showErrors(emailErrors);
    });

    // Submit global
    document.getElementById("registerForm").addEventListener("submit", function (e) {
        const firstName = document.querySelector('[name="first_name"]').value.trim();
        const lastName = document.querySelector('[name="last_name"]').value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const race = document.querySelector('[name="race"]').value;
        const date = document.querySelector('[name="date_picker"]').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let errors = [];

        if (!firstName || !lastName || !email || !password || !race || !date) {
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
