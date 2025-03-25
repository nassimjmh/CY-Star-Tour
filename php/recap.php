<?php
session_start();
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
            'payed' => ''
        ];


    $filePath = '../json/data/booking.json';
    $existingBookings = json_decode(file_get_contents($filePath), true);
    if (!is_array($existingBookings)) {
        $existingBookings = [];
    }
    $nextId = empty($existingBookings) ? 1 : max(array_keys($existingBookings)) + 1;
    $existingBookings[$nextId] = $bookingData;

    file_put_contents($filePath, json_encode($existingBookings, JSON_PRETTY_PRINT));
    $_SESSION['booking_success'] = $bookingData;
    header("Location: recap.php");
    exit();
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
                    <?php
                    $discount = 0;
                    if ($userRole === 'VIP') {
                        $discount = 0.10; // 10% discount for VIP
                    } elseif ($userRole === 'Stellar Elite') {
                        $discount = 0.30; // 30% discount for Stellar Elite
                    }
                    $discountedTotal = $total * (1 - $discount);
                    ?>
                      <p class="discount">Discount :</p>
                    <?php if($discount!==0){
                        echo $discount * 100 . "%";
                    }else{
                        echo "0"."%";
                    }
                   ?>
                    <p class="pricetexttotal">Total :</p>
                    <p class="souspricetexttotal"><?php echo number_format($discountedTotal, 2) ?> ₴</p>
                    
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
                        $transaction = "154632ABCZWTC";
                        $vendeur = "MI-1_I";
                        $retour = "payement.php";

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
                        <input class="confirm" type="submit" name="submit" value="Pay">
                        <button onclick="history.back()" class="back-btn">Back</button>
                    </form>
                    
                    </div>
                </div>
            </div>
            <div class="middle" >
                <div class="booking2">
                    <div class="name"><p>➤ Option</p></div>
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

                        <div class="role-section">
                            <p class="soustitre2">Client Role :</p>
                            <?php if ($userRole === 'VIP'): ?>
                                <p class="listrole vip" style="color: <?php echo $roleColor; ?>;">🌟 VIP</p>
                            <?php elseif ($userRole === 'Stellar Elite'): ?>
                                <p class="listrole stellar" style="color: <?php echo $roleColor; ?>;"> Stellar Elite</p>
                            <?php elseif ($userRole === 'Admin'): ?>
                                <p class="listrole admin" style="color: <?php echo $roleColor; ?>;"> Admin</p>
                            <?php else: ?>
                                <p class="listrole standard" style="color: <?php echo $roleColor; ?>;"> Standard Traveler</p>
                            <?php endif; ?>
                        </div>

                        <div class="role-benefits">
                            <p class="soustitre2">Your Benefits:</p>
                            <ul>
                                <?php foreach ($benefits as $benefit): ?>
                                    <li><?php echo htmlspecialchars($benefit, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </body>
</html>
