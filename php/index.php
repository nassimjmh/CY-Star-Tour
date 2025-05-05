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
    
                <div class="item" style="--position:1"><img src="https://videos.openai.com/vg-assets/assets%2Ftask_01jtgqsdkke0atte9fzm8hdxqz%2F1746466098_img_1.webp?st=2025-05-05T15%3A47%3A16Z&se=2025-05-11T16%3A47%3A16Z&sks=b&skt=2025-05-05T15%3A47%3A16Z&ske=2025-05-11T16%3A47%3A16Z&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skoid=8ebb0df1-a278-4e2e-9c20-f2d373479b3a&skv=2019-02-02&sv=2018-11-09&sr=b&sp=r&spr=https%2Chttp&sig=%2BEoVH9kMn6cbvHkhtk6FVs5FwFAXCWCGiq%2BrluaX8uE%3D&az=oaivgprodscus" alt="spaceship3"></img></div>
                <div class="item" style="--position:2"><img src="https://file.aiquickdraw.com/imgcompressed/img/compressed_a5c4e0956fd81026e77a51c297ee60dc.webp" alt="spaceship4"></img></div>
                <div class="item" style="--position:3"><img src="https://file.aiquickdraw.com/imgcompressed/img/compressed_6037a48a86cf4a546694501210a81c7f.webp" alt="spaceship5"></img></div>
                <div class="item" style="--position:4"><img src="https://videos.openai.com/vg-assets/assets%2Ftask_01jtgrh3e1fp4rs4x94dhn67p6%2F1746466881_img_0.webp?st=2025-05-05T15%3A59%3A09Z&se=2025-05-11T16%3A59%3A09Z&sks=b&skt=2025-05-05T15%3A59%3A09Z&ske=2025-05-11T16%3A59%3A09Z&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skoid=8ebb0df1-a278-4e2e-9c20-f2d373479b3a&skv=2019-02-02&sv=2018-11-09&sr=b&sp=r&spr=https%2Chttp&sig=vugPCQA8mfeNUvvijip0WOfcaAsodwnPXkOIIiILnVM%3D&az=oaivgprodscus" alt="spaceship6"></img></div>
                <div class="item" style="--position:5"><img src="https://www.nicepng.com/png/full/12-128122_spaceship-png-images-spaceship-png.png" alt="spaceship7"></img></div>
                <div class="item" style="--position:6"><img src="https://cdn.fleetyards.net/uploads/model/angled_view_colored/44/eb/ab77-3856-40da-9162-4774aa8c27f5/large_angled-v2-fleetchart-9642f4fa-0425-42b7-9f33-a301cd49f851.png" alt="spaceship8"></img></div>
            
                <div class="item" style="--position:1"><img src="https://videos.openai.com/vg-assets/assets%2Ftask_01jtgqsdkke0atte9fzm8hdxqz%2F1746466098_img_1.webp?st=2025-05-05T15%3A47%3A16Z&se=2025-05-11T16%3A47%3A16Z&sks=b&skt=2025-05-05T15%3A47%3A16Z&ske=2025-05-11T16%3A47%3A16Z&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skoid=8ebb0df1-a278-4e2e-9c20-f2d373479b3a&skv=2019-02-02&sv=2018-11-09&sr=b&sp=r&spr=https%2Chttp&sig=%2BEoVH9kMn6cbvHkhtk6FVs5FwFAXCWCGiq%2BrluaX8uE%3D&az=oaivgprodscus" alt="spaceship3"></img></div>
                <div class="item" style="--position:2"><img src="https://file.aiquickdraw.com/imgcompressed/img/compressed_a5c4e0956fd81026e77a51c297ee60dc.webp" alt="spaceship4"></img></div>
                <div class="item" style="--position:3"><img src="https://file.aiquickdraw.com/imgcompressed/img/compressed_6037a48a86cf4a546694501210a81c7f.webp" alt="spaceship5"></img></div>
                <div class="item" style="--position:4"><img src="https://videos.openai.com/vg-assets/assets%2Ftask_01jtgrh3e1fp4rs4x94dhn67p6%2F1746466881_img_0.webp?st=2025-05-05T15%3A59%3A09Z&se=2025-05-11T16%3A59%3A09Z&sks=b&skt=2025-05-05T15%3A59%3A09Z&ske=2025-05-11T16%3A59%3A09Z&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skoid=8ebb0df1-a278-4e2e-9c20-f2d373479b3a&skv=2019-02-02&sv=2018-11-09&sr=b&sp=r&spr=https%2Chttp&sig=vugPCQA8mfeNUvvijip0WOfcaAsodwnPXkOIIiILnVM%3D&az=oaivgprodscus" alt="spaceship6"></img></div>
                <div class="item" style="--position:5"><img src="https://www.nicepng.com/png/full/12-128122_spaceship-png-images-spaceship-png.png" alt="spaceship7"></img></div>
                <div class="item" style="--position:6"><img src="https://cdn.fleetyards.net/uploads/model/angled_view_colored/44/eb/ab77-3856-40da-9162-4774aa8c27f5/large_angled-v2-fleetchart-9642f4fa-0425-42b7-9f33-a301cd49f851.png" alt="spaceship8"></img></div>
            
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
