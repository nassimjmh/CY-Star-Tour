
<?php

// cookie checker

$file = '../json/data/users.json';
$users = json_decode(file_get_contents($file), true);
$error = "";

//cookies

if (!isset($_SESSION['email']) && isset($_COOKIE['remember_token'])) {
    foreach ($users as $email => $userData) {
        if (isset($userData['remember_token']) && $userData['remember_token'] === $_COOKIE['remember_token']) {
            $_SESSION['email'] = $email;
            $_SESSION["first_name"] = $userData["first_name"];
            $_SESSION["role"] = $userData["role"];
            $_SESSION["last_name"] = $userData["last_name"];
            $_SESSION["race"] = $userData["race"];
            $_SESSION["date_picker"] = $userData["date_picker"];
            $_SESSION["profile_pic"] = $userData["profile_pic"];
            $_SESSION["id"] = $userData["id"];
            header('Location: profil.php');
            exit();
        }
    }
}
?>



<nav>

    <ul>
        <li class="logo">
            <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo">
        </li>
        <li>
            <a class="underline" href="index.php">Home</a>
        </li>
        <li>
            <a class="underline" href="map.php">Destinations</a>
        </li>
        <li>
            <a class="underline" href="aboutus.php">About us</a>
        </li>
        <li>
            <button id="theme-toggle" aria-label="Changer le thème"> 🌑</button>
        </li>

        <?php
        $paidBookings = 0;
        if (isset($_SESSION['email'])):
            $recentlybooked = json_decode(file_get_contents('../json/data/booking.json'), true);
            $id = $_SESSION["id"];
            if ($recentlybooked === null) {
                echo "<p>Error loading booking data.</p>";
            } else {
        ?>

        <li class="research">
            <a href="book.php"><i class='bx bx-search research'></i></a>
        </li>

        <li class="cart-container">
            <div class="dropdown-cart">
                <p class="yo">Your Space Bag:</p>
                <hr>
                <?php if (!empty($recentlybooked)): ?>
                    <?php
                        $hasUnpaidBookings = false;
                        foreach ($recentlybooked as $reservationId => $value) {
                            $imgSrc = '../images/planet/' . strtolower($value["planet"]) . ".webp";
                            if ($value["id"] == $id && $value["payed"] == false) {
                                $hasUnpaidBookings = true;
                                $paidBookings++;
                                ?>

                                <button class="remove-booking" onclick="removeBooking('<?php echo $reservationId; ?>', event)">❌</button>

                                <a href="recap2.php?id=<?php echo urlencode($reservationId); ?>&planet=<?php echo urlencode($value['planet']); ?>" class="book-link">
                                    <div class="book">
                                        <p class="namebook"> <?php echo htmlspecialchars($value['planet'], ENT_QUOTES, 'UTF-8'); ?> </p>
                                        <p class="optionbook"><strong>✨ Quality travel :</strong> <?php echo htmlspecialchars($value['quality'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p class="optionbook"><strong>☕ Breakfast :</strong> <?php echo htmlspecialchars($value['breakfast'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p class="optionbook"><strong>💆‍♂️ Zero gravity relaxation :</strong> <?php echo htmlspecialchars($value['relax'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p class="optionbook"><strong>🛡️ Cancellation insurance :</strong> <?php echo htmlspecialchars($value['insurance'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <p class="optionbook"><strong>💸 Price :</strong> <?php echo htmlspecialchars($value['payment_amount'], ENT_QUOTES, 'UTF-8'); ?> ₴</p>
                                        <img src='<?php echo $imgSrc ?>' class='planet-image'>
                                    </div>
                                </a>
                                <?php
                            }
                        }
                        if (!$hasUnpaidBookings) {
                            echo '<p style="color: var(--black)">Your cosmic bag is empty — time to plan your next stellar adventure!</p>';
                        }
                    ?>
                <?php else: ?>
                    <p style="color: var(--black)">Your cosmic bag is empty — time to plan your next stellar adventure!</p>
                <?php endif; ?>
            </div>
            <i class='bx bx-shopping-bag cart-icon'></i>
            <span class="cart-count"><?php echo $paidBookings; ?></span>
        </li>

        <?php
            }
        endif;
        ?>
        <li class="connect">
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page != "profil.php") {
                if (isset($_SESSION['profile_pic'])) {
                    if (strpos($_SESSION['profile_pic'], 'http') === 0) {
                        $imgSrc = $_SESSION['profile_pic'];
                    } else {
                        $imgSrc = $_SESSION['profile_pic'];
                    }
            ?>


                    <a href="profil.php"><img src="<?php echo $imgSrc; ?>" alt="PP" class="profile-thumbnail" style="width: 40px; height: 40px; border-radius: 50%;"></a>
            <?php
                } else {
            ?>
                    <a href="profil.php"><i class='bx bx-user-circle connect'></i></a>
            <?php
                }
            } else {
            ?>
                <img src="../images/invisiblepfp.png" alt="PP" class="profile-thumbnail" style="width: 40px; height: 40px; border-radius: 50%; font-weight:bold;">
            <?php
            }
            ?>
        </li>
    </ul>
</nav>

<script src="../js/navbar.js"></script>
