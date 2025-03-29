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
    <title>Reservations - StarTour Admin</title>
    <link rel="icon" href="../../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../../css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body id="reservations">
<style>
        .sidebar ul li a[href="reservations.php"] {
            color: #5e9ae9;
            position: relative;
        }
        .sidebar ul li a[href="reservations.php"]::before {
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

    <div class="reservation-container">
        <div class="container-reservation">
            <section>
                <h2>Manage Reservations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>RID</th>
                            <th>UID</th>
                            <th>PP</th>
                            <th>PPP</th>
                            <th>PLANET</th>
                            <th>DURATION</th>
                            <th>QUALITY</th>
                            <th>OPTIONS</th>
                            <th>NB</th>
                            <th>DATE</th>
                            <th>PRICE</th>
                            <th>PAY</th>
                            <th>ADMIN ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $file = file_get_contents("../../json/data/booking.json");
                        $reservations = json_decode($file, true);
                        if(count($reservations)!=0){
                            foreach($reservations as $key => $reservation){
                                ?>      
                                <tr>
                                    <td><?php echo "R" . str_pad($key, 4, '0', STR_PAD_LEFT) ?></td>
                                    <td><?php echo "#" . str_pad($reservation["id"], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td><?php 
                                        $users = json_decode(file_get_contents("../../json/data/users.json"), true);
                                        foreach($users as $user) {
                                            if($user['id'] == $reservation['id']) {
                                                if (strpos($user["profile_pic"], 'http') === 0) {
                                                    $profilePic = $user["profile_pic"]; // For external links
                                                } else {
                                                    $profilePic = '../' . $user["profile_pic"]; // For local links in <upload> folder
                                                }
                                                break;
                                            }
                                        }
                                        ?>
                                        <img src="<?php echo $profilePic; ?>" alt="PP" class="profile-thumbnail" style="width: 25px; height: 25px; border-radius: 50%;">
                                    </td>
                                    <td>
                                        <?php 
                                        $imgSrc =  '../../images/planet/' . strtolower($reservation["planet"]) . ".webp";
                                        ?>
                                        <img src="<?php echo $imgSrc; ?>" alt="PPP" class="profile-thumbnail" style="width: 25px; height: 25px; border-radius: 50%;">
                                    </td>                                    
                                    <td><?php echo $reservation["planet"] ?></td>
                                    <td><?php echo count($reservation["days"]) . " activities" ?></td>
                                    <td><?php echo $reservation["quality"] ?></td>
                                    <td><?php 
                                    if (!strcmp($reservation["breakfast"],"Yes")){
                                        echo "☕";
                                    }else{ echo "❌";}
                                    if (!strcmp($reservation["relax"],"Yes")){
                                        echo "🧘";
                                    }else{ echo "❌";}
                                    if (!strcmp($reservation["insurance"],"Yes")){
                                        echo "🛡️";
                                    }else{ echo "❌";}
                                    
                                    
                                    
                                    ?></td>
                                    <td><?php echo $reservation["nbpeople"] . " 👥"?></td>
                                    <td><?php
                                        $selectedPlanetFile = file_get_contents("../../json/destination/" . $reservation["planet"] . ".json");
                                        $selectedPlanetData = json_decode($selectedPlanetFile, true);
                                        
                                        $selectedDate = $selectedPlanetData["date"][$reservation["selectedDate"]];
                                        
                                        echo $selectedDate["depart"] . " - " . $selectedDate["arrive"] . "<br>";
                                    ?></td>
                                    <td><?php $revenue= $reservation["payment_amount"];
                                    echo number_format($revenue, 0, '.', ',') . "₴";
                                    ?></td>
                                    <td><?php
                                    if ($reservation["payed"]){
                                        echo "✅";
                                    }else{
                                        echo "❌";
                                    }
                                    
                                    ?></td>
                                    <td>
                                    <div class="action-buttons">
                                        <button class="manage-button">
                                            <a href="edit_reservation.php?name= <?php /* echo urlencode($reservations['name']); */?>" class="manage-button">
                                                Edit Reservation
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
