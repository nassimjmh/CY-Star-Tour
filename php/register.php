<?php
session_start();

$file = 'users.json';


$users = json_decode(file_get_contents($file), true);
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];  // Correction ici (last-name -> last_name)
    $email = $_POST['email'];
    $password = $_POST['password'];
    $race = $_POST['race'];


    if (!isset($users[$email])) {

        $users[$email] = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'race' => $race,
            'date_picker' => $date_picker,
        ];


        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));


        $_SESSION['first_name'] = $first_name;

        // Rediriger vers la page de connexion
        header('Location: login.php');
        exit();
    } else {
        $error = "⚠️ Utilisateur déjà existant.";
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
    <link rel="stylesheet" href="register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body id="registermenu">
<header>
    <nav>
        <ul>
            <li class="logo">
                <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo">
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
                <a href="login.php"><i class='bx bx-user-circle connect'></i></a>
            </li>
        </ul>
    </nav>
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

        <div class="input-box">
            <details>
                <summary class="selecteur">Your Race?</summary>
                <div class="racelist">
                    <label>
                        <input type="radio" name="race" value="human"> Human
                    </label>
                    <label>
                        <input type="radio" name="race" value="IA"> IA
                    </label>
                    <label>
                        <input type="radio" name="race" value="Alien" > Alien
                    </label>
                    <label>
                        <input type="radio" name="race" value="Coruscant" > Coruscant
                    </label>
                </div>
            </details>
        </div>

        <div class="input-box">
            <details>
                <summary class="selecteur">Birth Date?</summary>
                <div class="Birthday" >
                    <input type="date" class="date" name="date_picker" min="4900-01-01" required>
                </div>
            </details>
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
