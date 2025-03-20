<?php  
    session_start();

    //acceder a la liste des planetes
    $file = '../json/destination/book.json';
    $planet=json_decode(file_get_contents($file), true);
    $files = '../json/destination' . ucfirst($planet['planets'][0]) . '.json';
    $planetinfo=json_decode(file_get_contents($files), true);


?>

<!DOCTYPE html>

<html>
    <head>
        <title>StarTour - Book</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/book.css">
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
                        <a href="login.html"><i class='bx bx-user-circle connect'></i></a>
                    </li>
                </ul>
            </nav>
        </header>
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <div class="rsearch noclick">
            <div class="title">
                <p>Where will be your next destination?</p>
                
            </div>
            <div class="start">
                <details>
                    <summary>Where From ?</summary>
                    <div class="dropdown-content">
                        <label>
                            <input type="radio" name="planete"> Atlantis
                        </label>
                        <label>
                            <input type="radio" name="planete"> Naboo
                        </label>
                        <label>
                            <input type="radio" name="planete"> Pandora
                        </label>
                        <label>
                            <input type="radio" name="planete"> Cybertron
                        </label>
                        <label>
                            <input type="radio" name="planete"> Coruscant
                        </label>
                    </div>
                </details>
            </div>
            <div class="end">
                <details>
                    <summary>Where to ?</summary>
                    <div class="dropdown-content">
                        <label>
                            <input type="radio" > Atlantis
                        </label>
                        <label>
                            <input type="radio" > Naboo
                        </label>
                        <label>
                            <input type="radio" > Pandora
                        </label>
                        <label>
                            <input type="radio" > Cybertron
                        </label>
                        <label>
                            <input type="radio" > Coruscant
                        </label>
                    </div>
                </details>
            </div>
            <div class="when">
                <details>
                    <summary>Pick a date :</summary>
                    <div class="dropdown-content">
                        <form>
                            <label for="datePicker">Choisissez une date :</label>
                            <input type="date" class="date" name="datePicker" min="4900-01-01">
                        </form>
                    </div>
                </details>
            </div>
            <div class="number">
                <details>
                    <summary>How many ?</summary>
                    <div class="dropdown-content">
                        <label>
                            <input type="radio" > ATLANTIS
                        </label>
                        <label>
                            <input type="radio" > ATLANTIS
                        </label>
                        <label>
                            <input type="radio" > ATLANTIS
                        </label>
                        <label>
                            <input type="radio" > ATLANTIS
                        </label>
                    </div>
                </details>
            </div>
            <div><button class="valid"><a href="#first_booking">Valid</a></button></div>
            
        </div>
        <div id="ancrage"></div>
        <a class="clickarrow" href="#ancrage"><svg class="arrows">
            <path class="a1" d="M0 0 L20 21.33 L40 0"></path>
            <path class="a2" d="M0 13.33 L20 34.66 L40 13.33"></path>
            <path class="a3" d="M0 26.66 L20 48 L40 26.66"></path>
            
        </svg>
        </a>
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <div class="middle">
            
            
            
            <?php foreach ($planet['planets'] as $index => $plnt): ?>
                <?php
                $files = '../json/destination/' . ucfirst($planet['planets'][$index]) . '.json';
                $planetinfo=json_decode(file_get_contents($files), true);
                ?>
                <a href="destination.php?planet=<?php echo ucfirst($planet['planets'][$index]); ?>"><div  class="booking">
                    <img src="<?php echo htmlspecialchars_decode($planetinfo['preimage'], ENT_QUOTES); ?>" alt="image de la planete">
                    <div class="name"><p>➤ <?php echo htmlspecialchars($planetinfo['name'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                    <div class="galaxy"><p>| <?php echo htmlspecialchars_decode($planetinfo['galaxy'], ENT_QUOTES); ?> </p></div>
                    <div class="info"><p><?php echo htmlspecialchars_decode($planetinfo['info'], ENT_QUOTES); ?></p></div>
                    <div class="division"><p>————————————————————————————————————————————————</p></div>
                    <div class="description"><p><?php echo htmlspecialchars_decode($planetinfo['resume'], ENT_QUOTES); ?></p></div>
                    <div class="prix"><p><?php echo htmlspecialchars_decode($planetinfo['prix'], ENT_QUOTES); ?></p></div> 
                </div></a>
            <?php endforeach; ?>

        </div>
        <!--------------------------------------->
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
