<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$file = '../json/data/users.json';

// Load the JSON file
$users = json_decode(file_get_contents($file), true);
$error = "";

$email = $_SESSION['email'];

if (!isset($users[$email])) {
    $error = "⚠️ User not found.";
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Get the data sent from the form
        $card_holder = trim($_POST['card_holder']);
        $card_number = trim($_POST['card_number']);
        $expiry_date = trim($_POST['expiry_date']);
        $cvv = trim($_POST['cvv']);

        // Validate the fields
        if (empty($card_holder)) {
            $error = "⚠️ Card holder name is required.";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $card_holder)) {
            $error = "⚠️ Card holder name must contain only letters and spaces.";
        } elseif (empty($card_number) || !preg_match("/^\d{16}$/", $card_number)) {
            $error = "⚠️ Card number must be 16 digits.";
        } elseif (!is_valid_card_number($card_number)) {
            $error = "⚠️ Invalid card number.";
        } elseif (empty($expiry_date) || !preg_match("/^\d{2}\/\d{2}$/", $expiry_date)) {
            $error = "⚠️ Expiry date must be in MM/YY format.";
        } elseif (empty($cvv) || !preg_match("/^\d{3}$/", $cvv)) {
            $error = "⚠️ CVV must be 3 digits.";
        }

        if ($error) {
            echo "<p style='color:red;'>$error</p>";
        } else {
            // If all fields are valid, save the card information in the JSON file
            $users[$email]['card_info'] = [
                'card_holder' => $card_holder,
                'card_number' => $card_number,
                'expiry_date' => $expiry_date,
                'cvv' => $cvv
            ];

            // Save the updated data back to the JSON file
            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

            // Redirect to the bank page or confirmation page
            header('Location: bank.php');
            exit();
        }
    }
}

// Function to validate card number using Luhn Algorithm
// FULL AI 
function is_valid_card_number($number) {
    $sum = 0;
    $alt = false;
    for ($i = strlen($number) - 1; $i >= 0; $i--) {
        $n = intval($number[$i]);
        if ($alt) {
            $n *= 2;
            if ($n > 9) {
                $n -= 9;
            }
        }
        $sum += $n;
        $alt = !$alt;
    }
    return $sum % 10 == 0;
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
