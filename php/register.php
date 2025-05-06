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
            'remember_token' => null,
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
         $_SESSION["remember_token"] = $users[$email]["remember_token"];
         $_SESSION["id"] = $users[$email]["id"];

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
        <input type="password" id="password" name="password" placeholder="Password">
        <i class='bx bxs-lock-alt' id="lockIcon" onclick="togglePasswordVisibility()"></i>
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
        
        
    </form>
</div>


<script src ="../js/register.js"></script>





</body>
</html>
