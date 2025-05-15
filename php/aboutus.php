
<?php
session_start();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>StarTour - About us</title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/aboutus.css">
        <link rel="stylesheet" href="../css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>
    
    <body id="aboutus">
        <header>
           <?php include("../php/navbar.php") ?>
        </header>


        <div class="image-earth">
            <video autoplay muted loop playsinline class="earth-video">
                <source src="https://upload.wikimedia.org/wikipedia/commons/1/18/The_Earth_in_4k.webm" type="video/webm">
                Your browser does not support the video tag.
            </video>

            <div class="textearth">
                <p>"Earth is the cradle of humanity, but one cannot live in a cradle forever." — Konstantin Tsiolkovsky</p>
            </div>
        </div>


        <a class="clickarrow" href="#ancrage"><svg class="arrows">
            <path class="a1" d="M0 0 L20 21.33 L40 0"></path>
            <path class="a2" d="M0 13.33 L20 34.66 L40 13.33"></path>
            <path class="a3" d="M0 26.66 L20 48 L40 26.66"></path>
        </svg>
        </a>


    <div id="aboutustext">
        <div id="ancrage" class="simplecentered"></div>
        <table>
            <tr>
              <td><div class="aboutusleft">
                <h3>Welcome to Star Tour: Your Gateway to the Stars!</h3>
                <p class="aboutusparagraphleft">At Star Tour, we believe that the universe is meant to be explored.
                    Founded in 2187, Star Tour has been at the forefront of intergalactic travel, offering unforgettable journeys to the farthest reaches of the cosmos.
                    Our mission is simple: to provide extraordinary travel experiences that transcend the boundaries of space and time.</p>
                </div></td>
              <td><img src="../images/bar.webp" alt=""></td>
            </tr>
            <tr>
                <td><img src="../images/bar2.webp" alt="leftimage"></td>
                <td><div class="aboutusright">
                <h3>Who We Are</h3>
                <p class="aboutusparagraphright">Star Tour is more than just a travel agency—we are pioneers of interstellar adventure.
                    Our team of expert astronauts, astrophysicists, and travel enthusiasts is dedicated to crafting journeys that are as unique as the destinations we visit.
                    From the crystalline forests of Lumina Prime to the volcanic landscapes of Pyros-7, we bring the wonders of the universe within your reach.</p>
                </div>  </td>
            </tr>
            <tr>
              <td><div class="aboutusleft">
                <h3>Our Vision</h3>
                <p class="aboutusparagraphleft">We envision a future where travel knows no limits.
                    Whether you’re seeking the thrill of exploring alien worlds, the tranquility of floating cities, or the awe-inspiring beauty of distant galaxies,
                    Star Tour is here to make your dreams a reality.
                    Our goal is to inspire curiosity, foster connections between species, and create memories that will last a lifetime.</p>
                </div></td>
                <td><img src="../images/bar3.webp" alt=""></td>
            </tr>
          </table>
        <br>
        <h2 class="simplecentered">The universe is calling—will you answer?</h2>
        </body>
    </div>
    
<!--FOOTER-->
<?php include("../php/footer.php") ?>

</html>
