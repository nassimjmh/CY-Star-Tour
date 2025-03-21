<?php

session_start();


if ( !isset($_SESSION['email']) && !isset($_SESSION['password']) ){

    header('location: login.php');
}


$offers = [
    ["title" => "🌙 Lunar Getaway", "description" => "Experience a romantic stay on the Moon with low-gravity dining and breathtaking Earthrise views.", "discount" => "50% Off - Book before Stardate 2103.5"],
    ["title" => "🪐 Saturn Luxury Cruise", "description" => "Glide through Saturn’s rings aboard the Starliner Deluxe, featuring zero-G spas and cosmic cocktails.", "discount" => "Save 30% on group bookings!"],
    ["title" => "🔥 Mars Adventure Pack", "description" => "Live like a Martian! Includes habitat stay, rover driving, and simulated dust storms.", "discount" => "Free Space Suit Rental for early reservations!"],
    ["title" => "🌠 Deep Space Mystery Tour", "description" => "Travel beyond the Solar System and uncover the secrets of interstellar travel!", "discount" => "First 10 Bookings get a VIP Astronaut Training session."]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarTour - Special Offers</title>
    <link rel="icon" href="../images/sparkles.png" type="image/png">
    <link rel="stylesheet" href="../css/map.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/offers.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<header>
    <?php include("navbar.php") ?>

</header>

<body>
<h1> Special Galactic Offers </h1>
<p>Exclusive limited-time deals for the ultimate space travelers!</p>

<div class="offer-container">
    <?php foreach ($offers as $offer) : ?>
        <div class="offer">
            <h2><?php echo $offer["title"]; ?></h2>
            <p><?php echo $offer["description"]; ?></p>
            <p><strong><?php echo $offer["discount"]; ?></strong></p>
            <a href="#" class="btn">Book Now</a>
        </div>
    <?php endforeach; ?>
</div>
</body>

<?php include("footer.php")?>

</html>
