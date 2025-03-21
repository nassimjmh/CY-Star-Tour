
<nav>
    <ul>
        <li class="logo">
            <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo" >
        </li>
        <li>
            <a class="underline" href="../index.html">Home</a>
        </li>
        <li>
            <a class="underline" href="../php/book.php">Destinations</a>
            <ul class="submenu">
                <li><a href="../php/map.php">Map</a></li>
                <li> <a href="../php/offers.php">Special Offers</a></li>
            </ul>

        </li>

        <li>
            <a class="underline" href="../php/aboutus.php">About us</a>
        </li>
        <li class="research">
            <a href="../php/book.php"><i class='bx bx-search research'></i></a>
        </li>
        <li class="connect">
            <?php $current_page = basename($_SERVER['PHP_SELF']);

            if ($current_page!= "profil.php"): ?>
                <a href="profil.php"><i class='bx bx-user-circle connect'></i></a>
            <?php endif; ?>
        </li>
    </ul>
</nav>
