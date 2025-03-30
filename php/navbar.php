
<nav>
    <ul>
        <li class="logo">
            <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo" >
        </li>
        <li>
            <a class="underline" href="index.php">Home</a>
        </li>
        <li>
            <a class="underline" href="map.php">Destinations</a>
            <!-- <ul class="submenu">
                <li> <a href="#">Special Offers</a></li>
            </ul>-->
        </li>

        <li>
            <a class="underline" href="aboutus.php">About us</a>
        </li>
        <li class="research">
            <a href="book.php"><i class='bx bx-search research'></i></a>
        </li>
        <li class="connect">
                    <?php
                    $current_page = basename($_SERVER['PHP_SELF']);
                    if ($current_page != "profil.php") {
                        if (isset($_SESSION['profile_pic'])) {
                            if (strpos($_SESSION['profile_pic'], 'http') === 0) {
                                $imgSrc = $_SESSION['profile_pic']; // For external links
                            } else {
                                $imgSrc = "../" . $_SESSION['profile_pic']; // For local links in <upload> folder
                            }
                    ?>
                        <a href="profil.php"><img src="<?php echo $imgSrc; ?>" alt="PP" class="profile-thumbnail" style="width: 40px; height: 40px; border-radius: 50%;"></a>
                    <?php
                        } else {
                            ?> <a href="profil.php"><i class='bx bx-user-circle connect'></i></a><?php
                        }
                    } else {
                        ?>
                        <img src="../images/invisiblepfp.png" alt="PP" class="profile-thumbnail" style="width: 40px; height: 40px; border-radius: 50%; font-weight:bold;">
                        <?php  }
                    ?>
                </li>
    </ul>
</nav>
