<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$json = file_get_contents("users.json");
$users = json_decode($json, true);

$email = $_SESSION['email'];

if (!isset($users[$email])) {
    die("User not found.");
}

$user = $users[$email];

$rolesPremium = [
    "VIP" => [
        "price" => 9.99,
        "description" => "Exclusive access to special offers and VIP events."
    ],
    "Stellar Elite" => [
        "price" => 19.99,
        "description" => "All VIP features + advanced space flight experiences."
    ]
];

if (isset($_POST['role'])) {
    $newRole = $_POST['role'];

    if (!isset($rolesPremium[$newRole])) {
        die("Invalid role.");
    }

    $users[$email]['role'] = $newRole;
    file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));

    $_SESSION['role'] = $newRole;
    header("Location: offers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarTour - Login</title>
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/payementrole.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<header>
    <?php include("navbar.php") ?>
</header>


<body>
<div class="container">
    <h1>Choose Your Premium Plan</h1>
    <div class="plans">
        <?php foreach ($rolesPremium as $role => $details) : ?>
            <div class="plan">
                <h2><?php echo $role; ?></h2>
                <p><?php echo $details["description"]; ?></p>
                <p class="price"><strong>Price: $<?php echo $details["price"]; ?> / month</strong></p>
                <form method="post">
                    <button type="submit" name="role" value="<?php echo $role; ?>">Get <?php echo $role; ?></button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>

<?php include("footer.php") ?>

</html>
