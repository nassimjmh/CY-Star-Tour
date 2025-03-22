<?php
session_start();

$file = 'users.json';


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
            'profile_pic' => 'https://api.dicebear.com/9.x/pixel-art/svg?seed=n' . $first_name
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
        $error = "⚠️ User already exists.";
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
    <link rel="stylesheet" href="../css/register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body id="registermenu">
<header>
    <?php include("navbar.php")?>
</header>

<div class="wrapper">
    <form method="POST">
        <h1>Register</h1>
        <div class="input-box">
            <input type="text" name="first_name" placeholder="First Name" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="text" name="last_name" placeholder="Last Name" required>
            <i class='bx bxs-user'></i>
        </div>

        <div class="input-box">
            <input type="email" name="email" placeholder="Email" required>
            <i class='bx bx-envelope'></i>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <hr class="separator"> <!-- Separator -->
        <div class="input-box date-box">
            <label>Birth Date</label>
            <input type="date" class="date" name="date_picker" min="3900-01-01" max="<?php echo date('Y')+2000; ?>-<?php echo date('m-d'); ?>" value="<?php echo date('Y')+2000; ?>-<?php echo date('m-d'); ?>" required>
        </div>

        <div class="input-box">
            <label>Your Race</label>
            <select name="race" required>
                <option value="" disabled selected>Select your race</option>
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

        <?php if (!empty($error)) : ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
