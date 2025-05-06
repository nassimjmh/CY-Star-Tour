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
        if (isset($_SESSION['email'])):
            // Charger les données JSON
            $recentlybooked = json_decode(file_get_contents('../json/data/booking.json'), true);
            $id = $_SESSION["id"];
            // Vérifier si le fichier JSON a été chargé correctement
            if ($recentlybooked === null) {
                echo "<p>Error loading booking data.</p>";
            } else {
        ?>



            <?php
            include '../php/cart.php';
            list($cartItems, $cartCount) = getCartItems();
            ?>

            

        <li class="research">
            <a href="book.php"><i class='bx bx-search research'></i></a>
        </li>

        <li class="cart-container">
            

            <div class="dropdown-cart">
                <p class="yo">Recently Booked Trips:</p>
                <hr>
                <?php if (!empty($recentlybooked)): ?>
                    <?php
                    
                        $paidBookings = 0;
                    
                        $hasUnpaidBookings = false; // Variable de contrôle
                        foreach ($recentlybooked as $reservationId => $value) {
                            $imgSrc = '../images/planet/' . strtolower($value["planet"]) . ".webp";
                            if ($value["id"] == $id && $value["payed"] == false) {
                                $hasUnpaidBookings = true; // Mettre à jour la variable de contrôle
                                $paidBookings ++ ;
                                ?>
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
                            echo "<p><p>No recently booked trips.</p></p>"; 
                        }
                    ?>
                <?php else: ?>
                    <p>No recently booked trips.</p>
                <?php endif; ?>
            </div>
            <i class='bx bx-shopping-bag cart-icon'></i>
            <span class="cart-count"><?php echo $paidBookings; ?></span>
        </li>

        <?php
            } // Fin de la vérification du chargement JSON
        endif;
        ?>
        <li class="connect">
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            if ($current_page != "profil.php") {
                if (isset($_SESSION['profile_pic'])) {
                    if (strpos($_SESSION['profile_pic'], 'http') === 0) {
                        $imgSrc = $_SESSION['profile_pic']; // For external links
                    } else {
                        $imgSrc = $_SESSION['profile_pic']; // For local links in <upload> folder
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

<script>
    // Fonction pour définir un cookie
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Fonction pour obtenir un cookie img
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length);
        }
        return null;
    }

    const button = document.getElementById('theme-toggle');
    const darkMode = getCookie('darkMode');

    // Appliquer le thème selon le cookie + icône
    if (darkMode === 'enabled') {
        document.body.classList.add('dark');
        button.textContent = '💡'; // soleil pour indiquer qu'on est en sombre
    } else {
        button.textContent = '🌑'; // lune pour indiquer qu'on est en clair
    }

    // Changement de thème + icône au clic
    button.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        if (document.body.classList.contains('dark')) {
            setCookie('darkMode', 'enabled', 365);
            button.textContent = '💡️';
        } else {
            setCookie('darkMode', 'disabled', 365);
            button.textContent = '🌑';
        }
    });

    // Gestion de l'affichage du panier
    const cartContainer = document.querySelector('.cart-container');
    const dropdownCart = document.querySelector('.dropdown-cart');

    cartContainer.addEventListener('click', (event) => {
        event.stopPropagation(); // Empêche la propagation de l'événement de clic
        dropdownCart.classList.toggle('active');
    });

    document.addEventListener('click', (event) => {
        if (!cartContainer.contains(event.target)) {
            dropdownCart.classList.remove('active');
        }
    });
</script>
