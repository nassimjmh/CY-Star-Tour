<?php  
    session_start();

    // Accéder à la liste des galaxies
    $file = '../json/data/destinations.json';
    $destination = json_decode(file_get_contents($file), true);
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les galaxies sélectionnées
        if (isset($_POST['galaxy'])) {
            $selectedGalaxies = $_POST['galaxy'];
        } else {
            $selectedGalaxies = [];
        }

        // Récupérer les expériences choisies (checkbox)
        if (isset($_POST['keywords'])) {
            $selectedExperiences = $_POST['keywords'];
        } else {
            $selectedExperiences = [];
        }

        // Récupérer les évaluations choisies
        if (isset($_POST['rating'])) {
            $selectedRatings = $_POST['rating'];
        } else {
            $selectedRatings = [];
        }

        // Récupérer les prix choisis
        if (isset($_POST['price'])) {
            $selectedPrices = $_POST['price'];
        } else {
            $selectedPrices = [];
        }
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>StarTour - Book</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/book.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <header class>
        <?php include("navbar.php") ?>
    </header>


    <body id="Book"> 

    <form method="POST" action="">
    <div class="rsearch noclick">
    <div class="title">
                <p>Where will be your next destination?</p>
                
            </div>
        <div class="start">
            <details open>
                <summary>Choose your galaxy :</summary>
                <div class="dropdown-content">
                    <label>
                        <input type="checkbox" name="galaxy[]" value="Stargate"> Stargate
                    </label>
                    <label>
                        <input type="checkbox" name="galaxy[]" value="Movie"> Movie
                    </label>
                    <label>
                        <input type="checkbox" name="galaxy[]" value="Star Wars"> Star Wars
                    </label>
                    <label>
                        <input type="checkbox" name="galaxy[]" value="Milky Way"> Milky Way
                    </label>
                    <label>
                        <input type="checkbox" name="galaxy[]" value="Ia"> Ia
                    </label>
                </div>
            </details>
        </div>
        <div class="end">
            <details open>
                <summary>Choose your experience :</summary>
                <div class="dropdown-content2">
                    <label>
                        <input type="checkbox" name="keywords[]" value="Exploration"> Exploration
                    </label>
                    <label>
                        <input type="checkbox" name="keywords[]" value="Initiation"> Initiation
                    </label>
                    <label>
                        <input type="checkbox" name="keywords[]" value="Relaxation"> Relaxation
                    </label>
                    <label>
                        <input type="checkbox" name="keywords[]" value="Cultural"> Cultural
                    </label>
                    <label>
                        <input type="checkbox" name="keywords[]" value="Adventure"> Adventure
                    </label>
                    <label>
                        <input type="checkbox" name="keywords[]" value="Party"> Party
                    </label>
                    <label>
                        <input type="checkbox" name="keywords[]" value="Observation"> Observation
                    </label>
                    <label>
                        <input type="checkbox" name="keywords[]" value="Survival"> Survival
                    </label>
                </div>
            </details>
        </div>
        <div class="when">
            <details open>
                <summary>Choose the rating :</summary>
                <div class="dropdown-content">
                    <label>
                        <input type="checkbox" name="rating[]" value="1"> ★
                    </label>
                    <label>
                        <input type="checkbox" name="rating[]" value="2"> ★★
                    </label>
                    <label>
                        <input type="checkbox" name="rating[]" value="3"> ★★★
                    </label>
                    <label>
                        <input type="checkbox" name="rating[]" value="4"> ★★★★
                    </label>
                    <label>
                        <input type="checkbox" name="rating[]" value="5"> ★★★★★
                    </label>
                </div>
            </details>
        </div>
        <div class="number">
            <details open>
                <summary>Choose the price :</summary>
                <div class="dropdown-content">
                    <label>
                        <input type="radio" name="price" value="1500"> ≤ 1.500 ₴
                    </label>
                    <label>
                        <input type="radio" name="price" value="1700"> ≤ 1.700 ₴
                    </label>
                    <label>
                        <input type="radio" name="price" value="1900"> ≤ 1.900 ₴
                    </label>
                    <label>
                        <input type="radio" name="price" value="2100"> ≤ 2.100 ₴
                    </label>
                    <label>
                        <input type="radio" name="price" value="2300"> ≤ 2.300 ₴
                    </label>
                </div>
            </details>
        </div>
        <div><button class="valid" type="submit" onclick="window.location.href='#ancrage';">Valid</button></div>
    </div>
</form>
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
            
            
        <div id="ancrage"></div>
        <?php foreach ($destination as $index => $planet): ?>
                <?php
                // Construire le chemin du fichier JSON
                $files = '../json/destination/' . ucfirst($planet['name']) . '.json';
                $planetinfo = json_decode(file_get_contents($files), true);

                // Ignorer la planète si son nom est 'vide'
                if (strtolower($planet['name']) === 'vide') {
                    continue;
                }

                // Vérifier si la galaxie de la planète correspond à l'une des galaxies sélectionnées
                if (!empty($selectedGalaxies) && !in_array(strtolower($planet['galaxy']), array_map('strtolower', $selectedGalaxies))) {
                    continue; // Si la galaxie n'est pas sélectionnée, on passe à la planète suivante
                }

                // Vérifier si des expériences sont sélectionnées et si elles correspondent à toutes celles de la planète
                if (isset($_POST['keywords']) && count($_POST['keywords']) > 0) {
                    // On compare les éléments sélectionnés avec ceux de la planète
                    $selectedKeywords = array_map('strtolower', $_POST['keywords']); // Liste des mots-clés sélectionnés, en minuscules
                    $planetKeywords = array_map('strtolower', $planet['key']); // Liste des mots-clés de la planète, en minuscules

                    // Vérifier que toutes les expériences sélectionnées sont présentes dans la liste des mots-clés de la planète
                    if (count(array_diff($selectedKeywords, $planetKeywords)) > 0) {
                        continue; // Si une expérience sélectionnée n'est pas présente dans la liste de la planète, on ignore cette planète
                    }
                }

                // Vérifier si l'évaluation de la planète correspond aux évaluations sélectionnées
                if (!empty($selectedRatings) && !in_array($planet['note'], $selectedRatings)) {
                    continue;
                }

                // Vérifier si un prix a été sélectionné
                if (isset($_POST['price'])) {
                    $selectedPrice = $_POST['price'];  // Le prix sélectionné par l'utilisateur
                    // Si le prix de la planète est inférieur ou égal à la valeur sélectionnée
                    if ($planet['price'] <= $selectedPrice) {
                        // Afficher la planète
                    } else {
                        // Ignorer la planète
                        continue;
                    }
                }

                ?>
                

                <a href="destination.php?planet=<?php echo ucfirst($planet['name']); ?>">
                    <div class="booking">
                        <img src="<?php echo htmlspecialchars_decode($planetinfo['preimage'], ENT_QUOTES); ?>" alt="image de la galaxy">
                        <div class="name"><p>➤ <?php echo htmlspecialchars($planetinfo['name'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                        <div class="galaxy"><p>| <?php echo htmlspecialchars_decode($planetinfo['galaxy'], ENT_QUOTES); ?> </p></div>
                        <div class="info"><p><?php echo htmlspecialchars_decode($planetinfo['info'], ENT_QUOTES); ?></p></div>
                        <div class="division"><p>————————————————————————————————————————————————</p></div>
                        <div class="description"><p><?php echo htmlspecialchars_decode($planetinfo['resume'], ENT_QUOTES); ?></p></div>
                        <div class="prix"><p><?php echo htmlspecialchars_decode($planetinfo['prix'], ENT_QUOTES); ?></p></div> 
                    </div>
                </a>
            <?php endforeach; ?>

        </div>
    </body>
    <?php include("footer.php") ?>
</html>



