<?php
session_start();

if ( !isset($_SESSION["role"]) || $_SESSION["role"] !== "Admin") {
        header('location: ../../index.html');
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
<body id="dashboard">
<?php include("bars.php") ?>

    <div class="reservation-container">
        <div class="container-reservation">
            <section>
                <h2>Manage Reservations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PP</th>
                            <th>PPP</th>
                            <th>PLANET</th>
                            <th>DURATION</th>
                            <th>QUALITY</th>
                            <th>BREAKFAST</th>
                            <th>RELAX</th>
                            <th>NB</th>
                            <th>DATE</th>
                            <th>INSURANCE</th>
                            <th>PAYED</th>
                            <th>ADMIN ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $file = file_get_contents("../../json/data/booking.json");
                        $reservations = json_decode($file, true);
                        if(count($reservations)!=0){
                            foreach($reservations as $reservations){
                                ?>      
                                <tr>
                                    <td><?php echo "#" . str_pad($reservations["id"], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td><?php 
                                        $users = json_decode(file_get_contents("../../json/data/users.json"), true);
                                        foreach($users as $user) {
                                            if($user['id'] == $reservations['id']) {
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
                                        $imgSrc =  '../../images/planet/' . strtolower($reservations["planet"]) . ".webp";
                                        ?>
                                        <img src="<?php echo $imgSrc; ?>" alt="PPP" class="profile-thumbnail" style="width: 25px; height: 25px; border-radius: 50%;">
                                    </td>                                    
                                    <td><?php echo $reservations["planet"] ?></td>
                                    <td><?php echo $reservations["days"][0] ?></td>
                                    <td><?php echo $reservations["quality"] ?></td>
                                    <td><?php echo $reservations["breakfast"] ?></td>
                                    <td><?php echo $reservations["relax"]  ?></td>
                                    <td><?php echo $reservations["nbpeople"] ?></td>
                                    <td><?php echo $reservations["selectedDate"] ?></td>
                                    <td><?php echo $reservations["insurance"] ?></td>
                                    <td><?php echo $reservations["payed"] === null ? $reservations["payed"] : 'No' ?></td>
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
