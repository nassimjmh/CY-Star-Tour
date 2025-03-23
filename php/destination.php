
<?php  
    session_start();
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
    

    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>StarTour - <?php echo htmlspecialchars($planet['name'], ENT_QUOTES, 'UTF-8'); ?> </title>
        <link rel="icon" href="../images/sparkles.png" type="image/png">
        <link rel="stylesheet" href="../css/destination.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
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
            <?php 
                $sub_schedule = array_slice($planet['schedule'], 1, 4);

                foreach ($sub_schedule as $index => $day): ?>
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
            <form action="recap.php?planet=<?php echo ucfirst($selectedPlanet); ?>" method="post">
                
                    <label class="titlerese noclick">| Select your machin :</label>
                        <div class="group">
                            <input type="checkbox"  name="days[]" value="1">
                            <label for="rday1">Day 1</label>
                            <input type="checkbox"  name="days[]" value="2">
                            <label for="rday2">Day 2</label>
                            <input type="checkbox"  name="days[]" value="3">
                            <label for="rday3">Day 3</label>
                            <input type="checkbox"  name="days[]" value="4">
                            <label for="rday4">Day 4</label>
                        </div>
                
                    <label class="titlerese noclick">| Select the travel quality : <br></label>
                        <div class="group">
                            <input type="radio"  name="quality" value="Standard" required>
                            <label >Standard </label>
                            <input type="radio"  name="quality" value="Premium" required>
                            <label >Premium</label>
                        </div>
                
                    <label class="titlerese noclick">| Breakfast included : <br></label>
                        <div class="group">
                            <input type="radio"  name="Breakfast" value="Yes" required>
                            <label >Yes </label>
                            <input type="radio"  name="Breakfast" value="No" required>
                            <label >No</label>
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
                    <label class="titlerese4 noclick">| Zero gravity relaxation : <br><br></label>
                    <div class="group4">
                            <input type="radio"  name="Relax" value="Yes" required>
                            <label >Yes </label>
                            <input type="radio"  name="Relax" value="No" required>
                            <label >No</label>
                        </div>
                    <label class="titlerese5 noclick">| Cancellation insurance : <br><br></label>
                    <div class="group5">
                            <input type="radio"  name="insurance" value="Yes" required>
                            <label >Yes </label>
                            <input type="radio"  name="insurance" value="No" required>
                            <label >No</label>
                        </div>
                        
                    

                    <label class="titlerese3 noclick">| Select the days : <br></label>
                        <div class="group3">
                            <?php foreach ($planet['date'] as $index => $date): ?>
                                    <input type="radio" name="date" value="<?php echo $index; ?>">
                                    <label>Departure : <?php echo htmlspecialchars($date['depart'], ENT_QUOTES, 'UTF-8'); ?></label>
                                    <label>Arrival : <?php echo htmlspecialchars($date['arrive'], ENT_QUOTES, 'UTF-8'); ?></label>
                                    <label>Price : <?php echo htmlspecialchars($date['prix'], ENT_QUOTES, 'UTF-8'); ?> ₴</label>
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
        <?php include("footer.php") ?>
    </body>
</html>
