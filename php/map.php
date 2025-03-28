<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>StarTour - Map</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/map.css">
        <link rel="stylesheet" href="../css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body id="Map">
        <header>
           <?php include("navbar.php") ?>
        </header>
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
        <div class="rsearch noclick">
            <div class="title">
                <p class="name">| Map of the galaxy</p>
                <div class="planet atlantis">
                    <a href="destination.php?planet=Atlantis"><img src="../images/planet/atlantis.webp" alt="atlantis"></a>
                    <p>Atlantis</p>
                </div>
                <div class="planet pandora">
                    <a href="destination.php?planet=Pandora"><img src="../images/planet/pandora.webp" alt="pandora"></a>
                    <p>Pandora</p>
                </div>
                <div class="planet naboo">
                       <a href="destination.php?planet=Naboo"><img src="../images/planet/naboo.webp" alt="naboo"></a>
                    <p>Naboo</p>
                </div>
                <div class="planet cybertron">
                <a href="destination.php?planet=Cybertron"><img src="../images/planet/cybertron.webp" alt="cybertron"></a>
                    <p>Cybertron</p>
                </div>
                <div class="planet scarif">
                  <a href="destination.php?planet=Scarif"><img src="../images/planet/atlantis.webp" alt="atlantis"></a>
                    <p>Scarif</p>
                </div>
                <div class="vaisseau axiom">
                    <a href="destination.php?planet=Axiom"><img src="../images/planet/axiom.webp" alt="earth"></a>
                    <p>Axiom</p>
                </div>
                <div class="planet earth">
                    <a href="destination.php?planet=Earth"><img src="../images/planet/earth.webp" alt="earth"></a>
                    <p>Earth</p>
                </div>
                <div class="planet asuras">
                   <a href="destination.php?planet=Asuras"><img src="../images/planet/asuras.webp" alt="asuras"></a>
                    <p>Asuras</p>
                </div>
                <div class="planet kamino">
                    <a href="destination.php?planet=Kamino"><img src="../images/planet/kamino.webp" alt="kamino"></a>
                    <p>Kamino</p>
                </div>
                <div class="planet grok">
                     <a href="destination.php?planet=Grok"><img src="../images/planet/grok.webp" alt="grok"></a>
                    <p>Grok</p>
                </div>
                <div class="planet mistral">
                    <a href="destination.php?planet=Mistral"><img src="../images/planet/mistral.webp" alt="mistral"></a>
                    <p>Mistral</p>
                </div>
                <div class="planet openai">
                     <a href="destination.php?planet=Openai"><img src="../images/planet/openai.webp" alt="openai"></a>
                    <p>Openai</p>
                </div>
                <div class="planet mars">
                     <a href="destination.php?planet=Mars"><img src="../images/planet/mars.webp" alt="mars"></a>
                    <p>Mars</p>
                </div>
                <div class="planet mann">
                     <a href="destination.php?planet=Mann"><img src="../images/planet/mann.png" alt="mars"></a>
                    <p>Mann</p>
                </div>
                <div class="planet arrakis">
                     <a href="destination.php?planet=Arrakis"><img src="../images/planet/arrakis.png" alt="mars"></a>
                    <p>Arrakis</p>
                </div>
            </div>
        </div>
        
        <!--------------------------------------->
  <!--FOOTER-->
<?php include("footer.php") ?>
    </body>

    
    
</html>
