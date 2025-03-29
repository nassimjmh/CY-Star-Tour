<?php
session_start();

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$return_url = rtrim($base_url, '/') . '/payement.php';

if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ){

    header('location: login.php');
}
    $total=0;
    $totaltravel = 0;
    if (isset($_GET['planet'])) {
        $selectedPlanet = $_GET['planet'];  
        $file = '../json/destination/' . ucfirst($selectedPlanet) . '.json';
        $planet = json_decode(file_get_contents($file), true);
        $_SESSION['planet_data'] = $planet;
    }

    $p=$_SESSION['planet_data'];// Récupérer la planete

    if (isset($_POST["submit"])) {
    
        $bookingData = [
            'id' => $_SESSION['user_id'],
            'planet' => $_GET['planet'],
            'days' => $_POST['days'] ?? [],
            'quality' => $_POST['quality'] ?? '',
            'breakfast' => $_POST['Breakfast'] ?? '',
            'relax' => $_POST['Relax'] ?? '',
            'nbpeople' => isset($_POST['nb']) ? (int)$_POST['nb'] : 1,
            'insurance' => $_POST['insurance'] ?? '',
            'selectedDate' => $_POST['date'] ?? [],
        ];


    $_SESSION['booking_success'] = $bookingData;
    header("Location: recap.php");
    exit();
///

}
$booking = $_SESSION['booking_success']; // Récupérer la réservation



$userRole = $_SESSION['role'];


$roleColors = [
    "Standard" => "#4CAF50",
    "VIP" => "gold",
    "Stellar Elite" => "#7851A9 ",
    "Admin" => "#5e9ae9"
];

$roleBenefits = [
    "Standard" => [
        "Standard trip without extras.",
        "Access to basic activities.",
        "Standard customer support."
    ],
    "VIP" => [
        "Access to luxury cabins.",
        "Priority boarding.",
        "10% discount on the total price."
    ],
    "Stellar Elite" => [
        "Vip advantages",
        "Zero-gravity cocktail included.",
        "Free spaceflight simulator.",
        "30% discount on the total price."
    ],

    "Admin" => [
        "Can see everything.",
    ]
];

$roleColor = $roleColors[$userRole];
$benefits = $roleBenefits[$userRole];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>StarTour - Book</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/recap.css?v=<?php echo time(); ?>">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <header class>
        <?php include("navbar.php") ?>
    </header>
    <body id="Book" style="background-image: url('<?php echo htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8'); ?>'); background-size: cover; background-position: center; height: 100vh; margin: 0;">

        <div class="middle" >
            <div class="booking">
                <div class="name"><p>➤ Travel program</p></div>
                <div class="division noclick"><p>———————————————————————————</p></div>

                <div class="listname">
                    
                    <div class="programme">    
                    <?php foreach ($p['schedule'] as $index => $day): ?>
                        <p class="soustitre">Day <?php echo $index; ?></p>
                        <?php if ($index !== 0 && $index !== 5): ?>
                            <?php if (in_array((string)$index, $booking['days'])): ?>
                                <?php $totaltravel++ ?>
                                <p class="trajet">
                                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;★&nbsp;<u><?php echo htmlspecialchars($day['title1'], ENT_QUOTES, 'UTF-8'); ?></u>
                                    <br> <br> <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★&nbsp;<u><?php echo htmlspecialchars($day['title2'], ENT_QUOTES, 'UTF-8'); ?></u>
                                </p>
                            <?php else: ?>
                                <p class="trajet">✘</p>
                            <?php endif; ?>
                        <?php elseif($index == 0): ?>
                            
                            <p class="trajet">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★&nbsp;<u><?php echo htmlspecialchars($day['title1'], ENT_QUOTES, 'UTF-8'); ?></u>
                                <br>
                                <?php echo htmlspecialchars($day['description1'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php echo htmlspecialchars($p['date'][$booking['selectedDate']]['depart'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php echo htmlspecialchars($day['description2'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        <?php else: ?>
                            
                            <p class="trajet">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;★&nbsp;<u><?php echo htmlspecialchars($day['title1'], ENT_QUOTES, 'UTF-8'); ?></u>
                                <br>
                                <?php echo htmlspecialchars($day['description1'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php echo htmlspecialchars($p['date'][$booking['selectedDate']]['arrive'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php echo htmlspecialchars($day['description2'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        <?php endif; ?>                            
                    <?php endforeach; ?> 
                    </div>
                </div>
                
                <div class="booking3">
                    <div class="name"><p>➤ Price</p></div>
                    <div class="division noclick"><p>————————————</p></div>
                    <p class="pricetext">Travel cost :</p>
                    <p class="souspricetext"><?php echo htmlspecialchars($p['date'][$booking['selectedDate']]['prix'], ENT_QUOTES, 'UTF-8'); ?> ₴</p>
                    <?php $total+= $p['date'][$booking['selectedDate']]['prix']?>
                    <p class="pricetext">Travel program per person :</p>
                    <?php $total+=$totaltravel*75 ?>
                    <p class="souspricetext"><?php echo htmlspecialchars($totaltravel, ENT_QUOTES, 'UTF-8'); ?> x 75 ₴ = <?php echo $totaltravel*75 ?> ₴</p>
                    <p class="pricetext">Number of passengers :</p>
                    <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x <?php echo htmlspecialchars($totaltravel*75, ENT_QUOTES, 'UTF-8'); ?>₴ = <?php echo $booking['nbpeople']*75*$totaltravel ?> ₴</p>
                    <?php $total+=$totaltravel*75*$booking['nbpeople'] ?>
                    <p class="pricetext">Quality travel :</p>
                    <?php if ($booking['quality'] === 'Standard'): ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 0 = 0 ₴</p>
                    <?php else: ?>
                        <?php $total+=50*$booking['nbpeople'] ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 50 ₴ = <?php echo 50*$booking['nbpeople'] ?> ₴</p>
                    <?php endif; ?>
                    <p class="pricetext">Breakfast :</p>
                    <?php if ($booking['breakfast'] === 'No'): ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 0 = 0 ₴</p>
                    <?php else: ?>
                        <?php $total+=25*$booking['nbpeople'] ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 25 ₴ = <?php echo 25*$booking['nbpeople'] ?> ₴</p>
                    <?php endif; ?>
                    <p class="pricetext">Zero gravity relaxation :</p>
                    <?php if ($booking['relax'] === 'No'): ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 0 = 0 ₴</p>
                    <?php else: ?>
                        <?php $total+=40*$booking['nbpeople'] ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 40 ₴ = <?php echo 40*$booking['nbpeople'] ?> ₴</p>
                    <?php endif; ?>
                    <p class="pricetext">Cancellation insurance :</p>
                    <?php if ($booking['insurance'] === 'No'): ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 0 = 0 ₴</p>
                    <?php else: ?>
                        <?php $total+=5*$booking['nbpeople'] ?>
                        <p class="souspricetext"><?php echo htmlspecialchars($booking['nbpeople'], ENT_QUOTES, 'UTF-8'); ?> x 5 ₴ = <?php echo 5*$booking['nbpeople'] ?> ₴</p>
                    <?php endif; ?>
                    <p class="pricetext">Discount :</p>
                    <?php
                        $discount = 0;
                        if ($userRole === 'VIP') {
                            $discount = 0.10; // 10% discount for VIP
                        } elseif ($userRole === 'Stellar Elite') {
                            $discount = 0.30; // 30% discount for Stellar Elite
                        }
                        $discountedTotal = $total * (1 - $discount);
                    ?>
                    <?php if ($discount !== 0) { ?>
                        <p class="souspricetext">
                            <?php echo ($discount * 100) . "%" ; ?>
                        </p>
                    <?php } else { ?>
                        <p class="souspricetext">
                            <?php echo $discount . " %"?>
                        </p>
                    <?php } ?>
                    
                    <p class="pricetext"><u>Total :</u></p>
                    <?php if ($discount !== 0) { ?>
                        <p class="souspricetext">
                            <?php echo $total . "&nbsp;" . "*" . "&nbsp;" . ($discount) . "&nbsp;" . "%" . "&nbsp;" . "=" . "&nbsp;"; ?>
                            <b><?php echo $discountedTotal; ?></b> <b>₴</b> 
                        </p>
                    <?php } else { ?>
                        <p class="souspricetext">
                            <b><?php echo $discountedTotal; ?></b> <b>₴</b> 
                        </p>
                    <?php } ?>
                    
                    
                </div>
        </div>
            </div>
        </div>
        <div class="option">
            <div class="middle" >
                <div class="booking2">
                    <div class="name"><p>➤ Passenger list</p></div>
                    <div class="division noclick"><p>———————————————————————————</p></div>

                    <div class="listname">
                        <?php
                            require('getapikey.php');
                            $montant=$total;
                            $length = rand(10, 24); // Random length between 10 and 24 characters
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // All characters possible
                            $transaction = '';
                            for ($i = 0; $i < $length; $i++) {
                                $transaction .= $characters[rand(0, strlen($characters) - 1)]; // Random transaction ID
                            }
                            $vendeur = "MI-1_I";
                            $retour = $return_url;

                            $api_key = getAPIKey($vendeur);
                            $control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
                        ?>
                 <form action='https://www.plateforme-smc.fr/cybank/index.php' method="POST"> 
                        <div>
                            <input type="text" name="nom[]" placeholder="Name" value="<?php echo htmlspecialchars($_SESSION["first_name"], ENT_QUOTES, 'UTF-8'); ?>"required>
                            <input type="text" name="prenom[]" placeholder="Last name" value="<?php echo htmlspecialchars($_SESSION["last_name"], ENT_QUOTES, 'UTF-8'); ?>"required>
                            <select id="options" name="options[]" >
                                <option value="option1">Human</option>
                                <option value="option2">IA</option>
                                <option value="option3">Alien</option>
                                <option value="option4">Coruscant</option>
                            </select>
                            <input type="number" name="age[]" placeholder="Age" min="0" required>

                        </div>
                        <?php
                        for ($i = 0; $i < $booking['nbpeople']-1; $i++) {
                        ?>
                            <div>
                                <input type="text" name="nom[]" placeholder="Name" required>
                                <input type="text" name="prenom[]" placeholder="Last name" required>
                                <select id="options" name="options[]">
                                    <option value="option1">Human</option>
                                    <option value="option2">IA</option>
                                    <option value="option3">Alien</option>
                                    <option value="option4">Coruscant</option>
                                </select>
                                <input type="number" name="age[]" placeholder="Age" min="0" required>

                                <input type='hidden' name='transaction'
                                       value='<?php echo $transaction; ?>'>
                                <input type='hidden' name='montant' value='<?php echo $montant; ?>'>
                                <input type='hidden' name='vendeur' value='<?php echo $vendeur; ?>'>
                                <input type='hidden' name='retour'
                                       value='payement.php'>
                                <input type='hidden' name='control'
                                       value='<?php echo $control; ?>'>
                            </div>
                        <?php
                        }
                        ?>
                        <input type='hidden' name='transaction'
                                   value='<?php echo $transaction; ?>'>
                            <input type='hidden' name='montant' value='<?php echo $montant; ?>'>
                            <input type='hidden' name='vendeur' value='<?php echo $vendeur; ?>'>
                            <input type='hidden' name='retour'
                                   value='<?php echo $return_url; ?>'>
                            <input type='hidden' name='control'
                                   value='<?php echo $control; ?>'>
                        <input class="confirm" type="submit" name="submit" value="Pay">
                        <a href="destination.php?planet=<?php echo rawurlencode($p['name']); ?>" class="back-btn">Cancel</a>
                    </form>
                    
                    </div>
                </div>
            </div>
            <div class="middle" >
                <div class="booking2">
                <div class="name">
                    <p>➤ Option 
                        <?php if ($userRole === 'VIP'): ?>
                            • <span class="listrole vip" style="color: <?php echo $roleColor; ?>;"> VIP</span>
                        <?php elseif ($userRole === 'Stellar Elite'): ?>
                            • <span class="listrole stellar" style="color: <?php echo $roleColor; ?>;"> Stellar Elite</span>
                        <?php elseif ($userRole === 'Admin'): ?>
                            • <span class="listrole admin" style="color: <?php echo $roleColor; ?>;"> Admin</span>
                        <?php else: ?>
                            • <span class="listrole standard" style="color: <?php echo $roleColor; ?>;"> Standard Traveler</span>
                        <?php endif; ?>
                        <label for="popup-toggle" class="popup-btn">?</label>
                    </p>
                </div>
                    <div class="division noclick"><p>———————————————————————————</p></div>

                    <div class="listname">
                        <?php if ($booking['quality'] === 'Standard'): ?>
                            <p class="soustitre2">Quality Travel :  &nbsp; &nbsp;Standard</p>
                            <p class="listprice">+ 0 ₴</p>
                            
                        <?php else: ?>
                            <p class="soustitre2">Quality Travel :  &nbsp; &nbsp; Premium</p>
                            <p class="listprice">+ 50 ₴</p>
                        <?php endif; ?>
                        <?php if ($booking['breakfast'] === 'Yes'): ?>
                            <p class="soustitre2">Breakfast :  &nbsp; Yes</p>
                            <p class="listprice2">+ 25 ₴</p>
                        <?php else: ?>
                            <p class="soustitre2">Breakfast :  &nbsp;  No</p>
                            <p class="listprice2">+ 0 ₴</p>
                        <?php endif; ?>
                        <?php if ($booking['relax'] === 'Yes'): ?>
                            <p class="soustitre2">Zero gravity relaxation :  &nbsp; Yes</p>
                            <p class="listprice3">+ 40 ₴</p>
                            
                        <?php else: ?>
                            <p class="soustitre2">Zero gravity relaxation :  &nbsp;  No</p>
                            <p class="listprice3">+ 0 ₴</p>
                        <?php endif; ?>
                        <?php if ($booking['insurance'] === 'Yes'): ?>
                            <p class="soustitre2">Cancellation insurance :  &nbsp; Yes</p>
                            <p class="listprice4">+ 5 ₴</p> 
                        <?php else: ?>
                            <p class="soustitre2">Cancellation insurance :  &nbsp;  No</p>
                            <p class="listprice4">+ 0 ₴</p>
                        <?php endif; ?>

                        
                            <input type="checkbox" id="popup-toggle">
                                <div class="popup-overlay">
                                    <div class="popup-content">
                                        <div class="role-benefits">
                                            <ul>
                                                <?php foreach ($benefits as $benefit): ?>
                                                    <li><?php echo htmlspecialchars($benefit, ENT_QUOTES, 'UTF-8'); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <label for="popup-toggle" class="close-btn">Close</label>
                                    </div>
                                </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="blanc"></div>
        <?php include("footer.php") ?>
    </body>
</html>
