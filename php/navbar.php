
<nav>
    <ul>
        <li class="logo">
            <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo" >
        </li>
        <li>
            <a class="underline" href="../index.html">Home</a>
        </li>
        <li>
            <a class="underline" href="../html/book.html">Destinations</a>
            <ul class="submenu">
                <li><a href="../html/map.html">Map</a></li>
            </ul>

        </li>

        <li>
            <a class="underline" href="../html/aboutus.html">About us</a>
        </li>
        <li class="research">
            <a href="../html/book.html"><i class='bx bx-search research'></i></a>
        </li>
        <li class="connect">
            <?php if (!isset($_SESSION['email']) && !isset($_SESSION['password'])): ?>
                <a href="profil.php"><i class='bx bx-user-circle connect'></i></a>
            <?php endif; ?>
        </li>
    </ul>
</nav>