
<?php  
    session_start();
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
         <?php include("navbar.php") ?>
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
            
        </div>
        <!--------------------------------------->
        <!--------------------------------------->
        <!--------------------------------------->
              <!--FOOTER-->
     <?php include("footer.php") ?>
    </body>
</html>
