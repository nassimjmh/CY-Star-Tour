<?php

session_start();

if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ){

    header('location: login.php');
}


$email = $_SESSION['email'];
$first_name= $_SESSION["first_name"];
$role= $_SESSION["role"];
$last_name= $_SESSION["last_name"];
$race = $_SESSION["race"];
$date_picker = $_SESSION["date_picker"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>StarTour - Profile</title>
    <meta charset="utf-8">
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<header>
    <?php include("navbar.php")?>
</header>

<main>


    <div class="sidebar">
        <div class="sidebar-head">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="img" class="profile-pic"><a href="#"><i class='bx bx-edit'></i></a>
        </div>
        <a href="#">Settings & Preferences &nbsp; <i class='bx bx-cog'></i></a>
        <a href="#">Payment & Billing &nbsp;<i class='bx bxs-credit-card'></i></a>
        <a href="#">Booking & Acess &nbsp;<i class='bx bxs-calendar'></i></a>
        <a href="#">Help & Support &nbsp;<i class='bx bx-phone'></i></a>
        <div class="status"> <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Standard') {
            echo ' <span style="color : green;">'.'Statut :&nbsp' . $role;
            }
else if( isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
    echo ' <span style="color : grey;">'.'Statut :&nbsp' . $role;
}

else if( isset($_SESSION['role']) && $_SESSION['role'] === 'VIP') {
    echo ' <span style="color : gold;">'.'Statut :&nbsp' . $role;
}
            ?> &nbsp;<i class='bx bxl-sketch'></i></div>

        <a class="logout" href="logout.php">Logout &nbsp;<i class='bx bx-log-out'></i></a>
    </div>


    <div class="info-profile">
        <div class="info">
            <div class="header"><h1>About me&nbsp<a href="#"><i class='bx bx-edit'></i></a></h1></div>
            <div class="line">
                <span class="label">Last Name: </span>
                <span class="value"><?php echo $last_name; ?></span>
            </div>
            <div class="line">
                <span class="label">First Name:</span>
                <span class="value"><?php echo $first_name; ?></span>
            </div>
            <div class="line">
                <span class="label">Email:</span>
                <span class="value"><?php echo $email; ?></span>
            </div>
            <div class="line">
                <span class="label">Race:</span>
                <span class="value"><?php echo $race; ?></span>
            </div>
            <div class="line">
                <span class="label">Date of Birth:</span>
                <span class="value"><?php echo $date_picker; ?></span>
            </div>
        </div>
        <div class="recent-trips">
            <h2>Recently Booked Trips</h2>
            <ul>
                <li>Mars</li>
                <li>Venus</li>
                <li>Kargalan</li>
                <li>Robotcorp</li>
                <li>Litunaria</li>
                <li>Icebergotum</li>
            </ul>
        </div>
    </div>




    <div class="destinations-info">
        <h2>Upcoming Destinations</h2>
        <ul>
            <li>Alpha Centauri</li>
            <li>Andromeda</li>
            <li>Proxima B</li>
            <li>Jupiter Moon</li>
        </ul>
        <a href="#" class="see-more-btn">See More</a>

    </div>

</main>


<!--FOOTER-->
<?php include("footer.php") ?>

</body>
</html>
