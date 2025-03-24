<?php
session_start();

if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ) {

    header('location: ../login.php');
}

if ( !isset($_SESSION['role']) && $_SESSION['role'] !== 'Admin') {
    
        header('location: ../../index.html');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin page for managing users on StarTour">
    <title>Dashboard - StarTour Admin</title>
    <link rel="icon" href="../../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="dashboard">

<?php include("bars.php") ?>

    <div class="dashboard">
        <div class="bento-box">
            <h2>!!!TEST Revenues!!!</h2>
            <p>Total revenues for the current period.</p>
            <div class="revenue">
                <h3><?php
                $destinations = json_decode(file_get_contents("../../json/data/destinations.json"), true);
                $totalRevenue = 0;
                foreach ($destinations as $destination) {
                    $totalRevenue += $destination["revenue"];
                }
                echo $totalRevenue . "₴";?></h3>
            </div>
        </div>
        <div class="bento-box">
            <h2>Total number of trips</h2>
            <p>Total trips for the current period.</p>
            <div class="sales">
                <h3><?php 
                $destinations = json_decode(file_get_contents("../../json/data/destinations.json"), true);
                $totalTrips = 0;
                foreach ($destinations as $destination) {
                    $totalTrips += $destination["trips"];
                }
                echo $totalTrips;?></h3>
            </div>
        </div>
        <div class="bento-box">
            <h2>User base</h2>
            <p>Users registered.</p>
            <div class="user-growth">
                <?php
                    $usersFile = '../../json/data/users.json';
                    if (file_exists($usersFile)) {
                        $usersData = json_decode(file_get_contents($usersFile), true);
                        $userCount = count($usersData);
                        echo "<h3>" . $userCount . "</h3>";
                    }
                ?>
            </div>
        </div>
        <div class="bento-box">
            <h2>Active Users</h2>
            <p>Users active in the last 30 days.</p>
            <div class="active-users">
                <h3>5,456</h3>
            </div>
        </div>
    </div> 

    </body>
</html>
