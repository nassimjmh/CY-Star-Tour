<?php
session_start();


if (!isset($_SESSION['email'])) {
header('Location: login.php');
exit();
}

$file = '../json/data/users.json';

// Charge le fichier JSON
$users = json_decode(file_get_contents($file), true);
$error = "";

$email = $_SESSION['email'];


if (!isset($users[$email])) {
$error = "⚠️ User not found.";
} else {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$card_holder = $_POST['card_holder'];
$card_number = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvv = $_POST['cvv'];


$users[$email]['card_info'] = [
'card_holder' => $card_holder,
'card_number' => $card_number,
'expiry_date' => $expiry_date,
'cvv' => $cvv
];

file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

header('Location: getapikey.php');
exit();
}
}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarTour - Card</title>
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/card.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<header>
    <?php include("navbar.php")?>

</header>



<body>


<div class="container">
    <h1> StarPay - Secure Payment</h1>
    <form action="card.php" method="POST">
        <div class="form-group">
            <label for="card_holder">Cardholder Name:</label>
            <input type="text" name="card_holder" id="card_holder" placeholder="John Doe" required>
        </div>

        <div class="form-group">
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456" required>
        </div>

        <div class="form-group">
            <label for="expiry_date">Expiration Date (MM/YY):</label>
            <input type="text" name="expiry_date" id="expiry_date" placeholder="12/26" required>
        </div>

        <div class="form-group">
            <label for="cvv">Security Code (CVV):</label>
            <input type="text" name="cvv" id="cvv" placeholder="123" required>
        </div>

        <button type="submit">Pay Now</button>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>

</div>


</body>

<footer>

    <?php include ("footer.php"); ?>
</footer>


</html>
