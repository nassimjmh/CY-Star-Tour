<?php
session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header('location: login.php');
}

$booking = $_SESSION['booking_success']; // Récupérer la réservation
$p = $_SESSION['planet_data']; // Récupérer la planète

$status = $_GET['status'] ?? null;
$montant = $_GET['montant'] ?? null;
$transaction = $_GET['transaction'] ?? null;
$vendeur = $_GET['vendeur'] ?? null;
$control = $_GET['control'] ?? null;

if ($status === 'accepted') {
    $booking['payment_amount'] = $montant;
    $booking['payment_transaction'] = $transaction;
    $booking['payed'] = true;
    $_SESSION['booking_success'] = $booking;

    // Enregistrer les informations
    $filePath = '../json/data/booking.json';
    $existingBookings = json_decode(file_get_contents($filePath), true);
    if (!is_array($existingBookings)) {
        $existingBookings = [];
    }

    // Utiliser la clé stockée dans la session pour mettre à jour la réservation
    $bookingKey = $_SESSION['booking_key'];
    if (isset($existingBookings[$bookingKey])) {
        // Mettre à jour la réservation existante
        $existingBookings[$bookingKey] = $booking;

        // Sauvegarder les modifications dans le fichier JSON
        file_put_contents($filePath, json_encode($existingBookings, JSON_PRETTY_PRINT));
    }

    header('Location: payement.php');
} elseif ($status === 'denied') {
    $booking['payment_amount'] = $montant;
    $booking['payment_transaction'] = $transaction;
    $booking['payed'] = false;
    $_SESSION['booking_success'] = $booking;
    header('Location: payement.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>StarTour - Book</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/payed.css?v=<?php echo time(); ?>">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <header class>
        <?php include("navbar.php") ?>
    </header>
    <body id="Book" style="background-image: url('<?php echo htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8'); ?>'); background-size: cover; background-position: center; height: 100vh; margin: 0;">

    
    <div class="payment-container">
        <div class="payment-box">
            <?php
                 if ($booking['payed']){?>
                    <h1 class="yes">Your payment has been accepted</h1>
                    <p><strong>Transaction ID :</strong> <?php echo $booking['payment_transaction'];?></p>
                    <p><strong>Amount :</strong> <?php echo $booking['payment_amount'];?> ₴</p>
                    <p><strong>Planet :</strong> <?php echo $booking['planet'];?></p>
                    <p><strong>Date :</strong> <?php echo $p['date'][$booking['selectedDate']]['depart'];?></p>
                    <p><strong>Quality travel :</strong> <?php echo $booking['quality'];?></p>
                    <p><strong>Breakfast :</strong> <?php echo $booking['breakfast'];?></p>
                    <p><strong>Zero gravity relaxation :</strong> <?php echo $booking['relax'];?></p>
                    <p><strong>Cancellation insurance :</strong> <?php echo $booking['insurance'];?></p>
                    <a href="index.php">
                        <button class="btn">Back to Home</button>
                    </a>
            <?php
                 }else{?>
                    <h1 class="no">Your payment has been declined</h1>
                    <p><strong>Transaction ID :</strong> <?php echo $booking['payment_transaction'];?></p>
                    <p>Your transaction has not been successful. Please try again. If the issue persists, feel free to contact us at contact@startour.com for assistance.</p>
                    <a href="recap.php">
                        <button class="btn">Retry</button>
                    </a>

            <?php
                 }
            ?>
            
            

        </div>
    </div>








        
    </body>
</html>
