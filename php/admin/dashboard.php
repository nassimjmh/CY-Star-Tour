<?php
session_start();

if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ) {

    header('location: ../login.php');
}

if ( !isset($_SESSION['role']) && $_SESSION['role'] !== 'Admin') {
    
    header('location: ../index.php');
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
<style>
        .sidebar ul li a[href="dashboard.php"] {
            color: #5e9ae9;
            position: relative;
        }
        .sidebar ul li a[href="dashboard.php"]::before {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 1px;
            background: #5e9ae9;
        }
</style>
<?php include("bars.php") ?>

    <div class="dashboard">
        <div class="bento-box">
            <h2>Revenues</h2>
            <p>Total revenues for the current period.</p>
            <div class="revenue">
                <h3><?php
                $totalRevenue = 0;
                $reservations = json_decode(file_get_contents("../../json/data/booking.json"), true);
                foreach ($reservations as $reservation) {
                    $totalRevenue += $reservation["payment_amount"];
                }
                // Format with commas
                echo number_format($totalRevenue, 0, '.', ',') . "₴";
                ?></h3>
            </div>
        </div>
        <div class="bento-box">
            <h2>Total number of trips</h2>
            <p>Total trips for the current period.</p>
            <div class="sales">
                <h3><?php 
                $bookings = json_decode(file_get_contents("../../json/data/booking.json"), true);
                $totalTrips = count($bookings);
                echo $totalTrips;
                ?></h3>
            </div>
        </div>
        <div class="bento-box">
            <h2>User base</h2>
            <p>Users registered.</p>
            <div class="user-growth">
                <h3><?php
                    $usersFile = '../../json/data/users.json';
                    if (file_exists($usersFile)) {
                        $usersData = json_decode(file_get_contents($usersFile), true);
                        $userCount = count($usersData);
                        echo $userCount;
                    }
                ?></h3>
            </div>
        </div>
        <div class="bento-box">
            <h2>Number of destinations</h2>
            <p>Number of currently available destinations</p>
            <div class="active-users">
                <h3><?php 
                $destinationFile = '../../json/data/destinations.json';
                if (file_exists($destinationFile)) {
                    $destinationData = json_decode(file_get_contents($destinationFile), true);
                    $destinationCount = count($destinationData);
                    echo $destinationCount;
                }
                ?></h3>
            </div>
        </div>
    </div> 

    </body>
</html>
