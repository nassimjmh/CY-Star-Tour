<?php
session_start();

if ( !isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
    header('location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin page for managing users on StarTour">
    <title>Destinations - StarTour Admin</title>
    <link rel="icon" href="../../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="destinations">
<style>
        .sidebar ul li a[href="destinations.php"] {
            color: #5e9ae9;
            position: relative;
        }
        .sidebar ul li a[href="destinations.php"]::before {
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

    <div class="destination-container">
        <div class="container-destination">
            <section>
                <h2>Manage Destinations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PP</th>
                            <th>NAME</th>
                            <th>GALAXY</th>
                            <th>DESCRIPTION</th>
                            <th>DISTANCE</th>
                            <th>REVENUE</th>
                            <th>TRIPS</th>
                            <th>ADMIN ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $file = file_get_contents("../../json/data/destinations.json");
                        $destinations = json_decode($file, true);
                        if(count($destinations)!=0){
                            foreach($destinations as $destinations){
                                ?>      
                                <tr>
                                    <td><?php echo "#" . str_pad($destinations["id"], 2, '0', STR_PAD_LEFT) ?></td>
                                    <td>
                                        <?php 
                                        $imgSrc =  '../../images/planet/' . $destinations["image"];
                                        ?>
                                        <img src="<?php echo $imgSrc; ?>" alt="PP" class="profile-thumbnail" style="width: 25px; height: 25px; border-radius: 50%;">
                                    </td>                                    
                                    <td><?php echo $destinations["name"] ?></td>
                                    <td><?php echo $destinations["galaxy"] ?></td>
                                    <td><?php echo $destinations["description"] ?></td>
                                    <td><?php echo $destinations["distance"] . " kpc" ?></td>
                                    <td><?php
                                    $reservationsFile = file_get_contents("../../json/data/booking.json");
                                    $reservations = json_decode($reservationsFile, true);
                                    $totalRevenue = 0;
                                    foreach ($reservations as $reservation) {
                                        if ($reservation["planet"] === $destinations["name"]) {
                                            $totalRevenue += $reservation["payment_amount"];
                                        }
                                    }
                                    echo number_format($totalRevenue, 0, '.', ',') . "₴";
                                    // Update the revenue in destinations.json
                                    $allDestinations = json_decode(file_get_contents("../../json/data/destinations.json"), true);
                                    if (isset($allDestinations[$destinations["name"]])) {
                                        $allDestinations[$destinations["name"]]["revenue"] = $totalRevenue;
                                        file_put_contents("../../json/data/destinations.json", json_encode($allDestinations, JSON_PRETTY_PRINT));
                                    }

                                    ?></td>
                                    <td><?php
                                    $reservationsFile = file_get_contents("../../json/data/booking.json");
                                    $reservations = json_decode($reservationsFile, true);
                                    $totalTrips = 0;
                                    foreach ($reservations as $reservation) {
                                        if ($reservation["planet"] === $destinations["name"]) {
                                            $totalTrips += 1;
                                        }
                                    }
                                    echo $totalTrips . " trips";
                                    // Update the Trips number in destinations.json
                                    $allDestinations = json_decode(file_get_contents("../../json/data/destinations.json"), true);
                                    if (isset($allDestinations[$destinations["name"]])) {
                                        $allDestinations[$destinations["name"]]["trips"] = $totalTrips;
                                        file_put_contents("../../json/data/destinations.json", json_encode($allDestinations, JSON_PRETTY_PRINT));
                                    }
                                    ?></td>
                                    <td>
                                    <div class="action-buttons">
                                        <button class="manage-button">
                                            <a href="edit_destination.php?name=<?php echo urlencode($destinations['name']); ?>" class="manage-button">
                                                Edit Destination
                                            </a>
                                        </button>
                                    </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    </body>
</html>
