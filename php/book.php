<?php  
    session_start();

    // Accéder à la liste des galaxies
    $file = '../json/data/destinations.json';
    $destination = json_decode(file_get_contents($file), true);
?>

<!DOCTYPE html>

<html>
    <head>
        <title>StarTour - Book</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/book.css?v=<?php echo time(); ?>">
        <script src="../js/search.js?v=<?php echo time(); ?>"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <header class>  
        <?php include("navbar.php") ?>
    </header>


    <body id="Book"> 

    <form>
    <div class="rsearch noclick">
        <div class="end">
                <summary>GALAXY</summary>
                <div class="dropdown-content3">
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
                    <label>
                        <input type="checkbox" name="galaxy[]" value="Game"> Game
                    </label>
                </div>
            </details>
        </div>
        <div class="start">
                <summary>EXPERIENCE</summary>
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
                <summary>RATING</summary>
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
                <summary>PRICE RANGE</summary>
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
        <button type="button" class="valid">Reset Filters</button>
    </div>
    
</form>
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <div class="middle">
            
            
        <?php foreach ($destination as $index => $planet): ?>
                <?php
                // Construire le chemin du fichier JSON
                $files = '../json/destination/' . ucfirst($planet['name']) . '.json';
                $planetinfo = json_decode(file_get_contents($files), true);

                // Ignorer la planète si son nom est 'vide'
                    if (strtolower($planet['name']) === 'vide') {
                        continue;
                    }
                ?>

                <a href="destination.php?planet=<?php echo ucfirst($planet['name']); ?>">
                <!-- Data to filter destinations -->    
                <div class="booking" 
                    data-galaxy="<?php echo strtolower($planet['galaxy']); ?>" 
                    data-keywords="<?php echo implode(',', array_map('strtolower', $planet['key'])); ?>" 
                    data-rating="<?php echo $planet['note']; ?>" 
                    data-price="<?php echo $planet['price']; ?>">

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
            <a href="#">
            <div id="no-results" style="display: none;">
            <div class="booking"</div>
                        <img src="../images/ouvrier.jpg">
                        <div class="name"><p>➤ No results...</p></div>
                        <div class="galaxy"><p>| Li&bili </p></div>
                        <div class="info"><p>🌡️ 115.1°K(ea)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⬇🌍 8.88 m/s²</p></div>
                        <div class="division"><p>————————————————————————————————————————————————</p></div>
                        <div class="description"><p>Nobody has the <strong>model</strong> they need to find the <strong>result</strong>.
And yet, the <strong>system</strong> behaves as if governed by <strong>linear</strong> rules, quietly evolving in time.
Perhaps the <strong>planet</strong> is <strong>trigonalisable...</strong> we just haven’t identified the correct <strong>basis</strong> yet.</p></div>
                        <div class="prix"><p>9.999₴</p></div> 
                    </div>
                </a>
            </div>
        </div>
    </body>
    <?php include("footer.php") ?>
</html>



