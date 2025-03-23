
<?php  
   
if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ){

    header('location: login.php');
}


//Ouvrir le bon fichier
   

if (isset($_GET['planet'])) {
        $selectedPlanet = $_GET['planet'];
    }   else {
        header("Location: map.php");
        exit;
    }
    $file = '../json/destination/' . ucfirst($selectedPlanet) . '.json';
    if (file_exists($file)) {
        $planet=json_decode(file_get_contents($file), true);
    } else {
        header("Location: map.php");
    }
    //Enregistrer les informations de book
    if(isset($_POST["submit"])){
        
        $bookingData = [
            'id' => '12',  // faut automatiser
            'planet' => isset($_GET['planet']) ? $_GET['planet'] : '',  
            'days' => isset($_POST['days']) ? $_POST['days'] : [],  
            'quality' => isset($_POST['quality']) ? $_POST['quality'] : '',  
            'breakfast' => isset($_POST['Breakfast']) ? $_POST['Breakfast'] : '',  
            'nbpoeple' => isset($_POST['nb']) ? $_POST['nb'] : 0,  
            'selectedDate' => isset($_POST['date']) ? $_POST['date'] : [],
            'payed' => ''
        ];
        
        // Récupérer les informations des voyageurs
        $travelers = [];
        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age'])) {
            $nbTravelers = $_POST['nb'];
            for ($i = 0; $i < $nbTravelers; $i++) {
                $travelers[] = [
                    'nom' => $_POST['nom'][$i],
                    'prenom' => $_POST['prenom'][$i],
                    'age' => $_POST['age'][$i]
                ];
            }
        }
        
        // Ajouter les voyageurs au tableau de données de réservation
        $bookingData['travelers'] = $travelers;

    // Ajouter l'ID de réservation au bookingData
        $filePath = '../json/data/booking.json';
        $existingBookings = json_decode(file_get_contents($filePath), true);
        if (!is_array($existingBookings)) {
            $existingBookings = [];
        }
        $nextId = empty($existingBookings) ? 1 : max(array_keys($existingBookings)) + 1;
        $existingBookings[$nextId] = $bookingData;
    
        file_put_contents($filePath, json_encode($existingBookings, JSON_PRETTY_PRINT));
    
    
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>StarTour - <?php echo htmlspecialchars($planet['name'], ENT_QUOTES, 'UTF-8'); ?> </title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/destination.css">
        <link rel="stylesheet" href="../css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body id="Book">
        <header>
            <nav>
                <ul>
                    <li class="logo">
                        <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo" >
                    </li>
                    <li>
                        <a class="underline" href="../index.html">Home</a>
                    </li>
                    <li>
                        <a class="underline" href="book.html">Destinations</a>
                        <ul class="submenu">
                            <li><a href="../map.html">Map</a></li>
                        </ul>
                    
                    </li>
                       
                    <li>
                        <a class="underline" href="aboutus.html">About us</a>
                    </li>
                    <li class="research">
                        <a href="book.html"><i class='bx bx-search research'></i></a>
                    </li>
                    <li class="connect">
                        <a href="login.html"><i class='bx bx-user-circle connect'></i></a>
                    </li>
                </ul>
            </nav>
        </header>
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <div class="rsearch noclick" style="background-image: url('<?php echo htmlspecialchars($planet['image'], ENT_QUOTES, 'UTF-8'); ?>');">
            <div class="title">
                <p><?php echo htmlspecialchars($planet['name'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
        <!--------------------------------------->
        <div class="presentation">
            <p class="presentationtitle">Presentation</p>
            <p class="presentationdescription"><?php echo htmlspecialchars_decode($planet['presentation'], ENT_QUOTES); ?></p>
                                            
        </div>
        <!--------------------------------------->
        <div class="program">
            <p class="programtitle">Schedule</p>
            <?php foreach ($planet['schedule'] as $index => $day): ?>
                <div class="day">
                    <div class="daytitle"><p><?php echo "Day " . ($index + 1); ?></p></div>
                        <div class="daydescription"><p><?php echo htmlspecialchars($day['title1'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                        <div class="daydescription2"><p><?php echo htmlspecialchars_decode($day['description1'], ENT_QUOTES); ?></p></div>
                        <div class="daydescription"><p><?php echo htmlspecialchars($day['title2'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                        <div class="daydescription2"><p><?php echo htmlspecialchars_decode($day['description2'], ENT_QUOTES); ?></p></div>
                    </div>
            <?php endforeach; ?>
        </div>
        <!--------------------------------------->
        <div class="reserve">
            <p class="reservetitle">Book</p>
            <form action="destination.php?planet=<?php echo ucfirst($selectedPlanet); ?>" method="post">
                
                    <label class="titlerese noclick">| Select your machin :</label>
                        <div class="group">
                            <input type="checkbox"  name="days[]" value="Day 1">
                            <label for="rday1">Day 1</label>
                            <input type="checkbox"  name="days[]" value="Day 2">
                            <label for="rday2">Day 2</label>
                            <input type="checkbox"  name="days[]" value="Day 3">
                            <label for="rday3">Day 3</label>
                            <input type="checkbox"  name="days[]" value="Day 4">
                            <label for="rday4">Day 4</label>
                        </div>
                
                    <label class="titlerese noclick">| Select the travel quality : <br></label>
                        <div class="group">
                            <input type="radio"  name="quality" value="Standard" required>
                            <label >Standard </label>
                            <input type="radio"  name="quality" value="Premium" required>
                            <label >Premium</label>
                        </div>
                
                    <label class="titlerese noclick">| Breakfast included ? <br></label>
                        <div class="group">
                            <input type="radio"  name="Breakfast" value="Yes" required>
                            <label >Yes </label>
                            <input type="radio"  name="Breakfast" value="No" required>
                            <label >Non</label>
                        </div>
                
                    <label class="titlerese2 noclick">| Total number of travelers : <br></label>
                        <div class="selectgroup2">
                            <select name="nb">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="group2">
                            <input type="text" name="nom[]" placeholder="Name" required>
                            <input type="text" name="prenom[]" placeholder="Last name" required>
                            <input type="number" name="age[]" placeholder="Age" min="0" required>
                        </div>
                        <?php
                            for ($i = 0; $i < 5; $i++) {
                                ?>
                                <div class="group2">
                                    <input type="text" name="nom[]" placeholder="Name">
                                    <input type="text" name="prenom[]" placeholder="Last name">
                                    <input type="number" name="age[]" placeholder="Age" min="0" >
                                </div>
                                <?php
                            }
                        ?> 
                    

                    <label class="titlerese3 noclick">| Select the days : <br></label>
                        <div class="group3">
                            <?php foreach ($planet['date'] as $index => $date): ?>
                                    <input type="radio" name="date" value="<?php echo $index; ?>">
                                    <label>Departure : <?php echo htmlspecialchars($date['depart'], ENT_QUOTES, 'UTF-8'); ?></label>
                                    <label>Arrival : <?php echo htmlspecialchars($date['arrive'], ENT_QUOTES, 'UTF-8'); ?></label>
                                    <label>Price : <?php echo htmlspecialchars($date['prix'], ENT_QUOTES, 'UTF-8'); ?></label>
                                    <br><br>
                            <?php endforeach; ?>
                            <label></label>
                        </div>


                            <input class="confirm" type="submit" name="submit" value="Submit">
                        
                
            </form>
        </div>
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
              <!--FOOTER-->
     <footer>
        <div class="footer-container">
            <div class="footer-section about">
                <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo-footer" >
                <ul class="payment-logos">
                    <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/american-express.svg" alt="amex"></il>
                    <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/cartes-bancaires.svg" alt="cartebleue"></il>
                    <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/apm/paypal.svg" alt="paypal"></il>
                    <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/mastercard.svg" alt="mastercard"></il>
                    <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/visa.svg" alt="visa"></il>
                    <il><img src="../images/bitcoin.svg" alt="bitcoin"></il>
                </ul>
            </div>
            <div class="footer-section links">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="book.html">Destinations</a></li>
                    <li><a href="aboutus.html">About us</a></li>
                    <li><a href="admin/dashboard.html">Services (admin page)</a></li>
                    <li><a href="profil.html">Contact (profile page)</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3>Contact</h3>
                <p>Email: contact@startour.com</p>
                <p>Phone: +0 831 576 989</p>
                <p>Address: 49.035, 2.0698 Earth</p>
            </div>
            <div class="footer-section social">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#">Bluesky</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 4090 CY StarTour. All rights reserved.</p>
        </div>
    </footer>
    </body>
</html>
