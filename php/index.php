<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>StarTour - Home</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body id="Fond">
        <header>
           <?php include("navbar.php") ?>
        </header>

        <div class="background noclick">
            <div class="title">
                <p>TRAVELING TO SPACE <br>HAS NEVER BEEN SO EASY</p>
            </div>
            
        </div>


        <div class="reco">
            <p class="best noclick">The best destinations of the moment</p>
            <a href="destination.php?planet=Naboo">
            <div class="recom">
                <img src="https://www.merchmates.co.uk/wp-content/uploads/2024/07/Star-Wars-Planets-Naboo-1024x536.webp" alt="">
                <div class="name noclick"><p>Naboo</p></div>
                <div class="galaxy noclick"><p>| StarWars - ★★★★★ </p></div>
            </div></a>
            <a href="destination.php?planet=Scarif">
            <div class="recom">
                <img src="https://preview.redd.it/8z0hoflvri211.jpg?auto=webp&s=f0dd91685d9be9ac55900619e45e16500fee5b0b" alt="">
                <div class="name noclick"><p>Scarif</p></div>
                <div class="galaxy noclick"><p>| StarWars - ★★★★☆ </p></div>
            </div></a>
            <a href="destination.php?planet=Cybertron">
            <div class="recom">
                <img src="https://miro.medium.com/v2/resize:fit:1400/1*QTp5-u_-XbELkf_cTJqMVw.png" alt="">
                <div class="name noclick"><p>Cybertron</p></div>
                <div class="galaxy noclick"><p>| Movie - ★★★★☆ </p></div>
            </div></a>
            <a href="destination.php?planet=Asuras">
            <div class="recom">
                <img src="https://www.stargate-fusion.com/uploads/recordpictures/2861/4798/24b3c91933cdce4a44ac-big.jpg?v=afb670642e40324978a3c215a7d84193" alt="">
                <div class="name noclick"><p>Asuras</p></div>
                <div class="galaxy noclick"><p>| Stargate - ★★★★☆ </p></div>
            </div></a>
        </div>
        <div class="banner">
            <p class="bannertitle noclick">Our spacecraft</p>
            <div class="slider" style="--quantity:5">
    
                <div class="item" style="--position:1"><img src="../images/spaceships/COLDSHIP.webp" alt="spaceship3"></img></div>
                <div class="item" style="--position:2"><img src="../images/spaceships/TRANSFORMERS.webp" alt="spaceship4"></img></div>
                <div class="item" style="--position:3"><img src="../images/spaceships/DISNEY.webp" alt="spaceship5"></img></div>
                <div class="item" style="--position:4"><img src="../images/spaceships/BIGBOAT.webp" alt="spaceship6"></img></div>
                <div class="item" style="--position:5"><img src="../images/spaceships/LUXURIOUS.webp" alt="spaceship7"></img></div>
                <div class="item" style="--position:6"><img src="../images/spaceships/NATURE.webp" alt="spaceship8"></img></div>
                <div class="item" style="--position:7"><img src="../images/spaceships/CITY.webp" alt="spaceship8"></img></div>
                
                <div class="item" style="--position:1"><img src="../images/spaceships/COLDSHIP.webp" alt="spaceship3"></img></div>
                <div class="item" style="--position:2"><img src="../images/spaceships/TRANSFORMERS.webp" alt="spaceship4"></img></div>
                <div class="item" style="--position:3"><img src="../images/spaceships/DISNEY.webp" alt="spaceship5"></img></div>
                <div class="item" style="--position:4"><img src="../images/spaceships/BIGBOAT.webp" alt="spaceship6"></img></div>
                <div class="item" style="--position:5"><img src="../images/spaceships/LUXURIOUS.webp" alt="spaceship7"></img></div>
                <div class="item" style="--position:6"><img src="../images/spaceships/NATURE.webp" alt="spaceship8"></img></div>
                <div class="item" style="--position:7"><img src="../images/spaceships/CITY.webp" alt="spaceship8"></img></div>



            </div>
        </div>
        <div class="image noclick">
                <p class="avis">"A marvel of speed and comfort!"</p>
                <p class="avis"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⭐⭐⭐⭐</p>
                <p class="avis2">"It's a perfect 20/20, nothing to say !"</p>
                <p class="avis2"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⭐⭐⭐⭐⭐ </p>
                <p class="avis3">"A space trip to take and retake !"</p>
                <p class="avis3"><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;⭐⭐⭐⭐</p>
            
                <p class="nameavis2">-M. Grignon</p>
        </div>
        
        
        

    <!--FOOTER-->
    <?php include("footer.php") ?>
    </body>
    
</html>
