<header>
        <nav>
            <ul>
                <li class="logo">
                    <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo">
                </li>
                <li class="panellogo"><img src="../../images/adminpanel.png" alt=""></li>
                <li><a class="underline" href="../index.php">Exit</a></li>
                <li><a id="theme-toggle">💡</a></li>
                
                <li class="connect">
                    <?php 
                    if (isset($_SESSION['profile_pic'])) {
                        if (strpos($_SESSION['profile_pic'], 'http') === 0) {
                            $imgSrc = $_SESSION['profile_pic']; // For external links
                        } else {
                            $imgSrc = '../' . $_SESSION['profile_pic']; // For local links in <upload> folder
                        }
                    ?>
                    <a href="../profil.php"><img src="<?php echo $imgSrc; ?>" alt="PP" class="profile-thumbnail" style="width: 40px; height: 40px; border-radius: 50%;"></a>
                <?php
                    } else {
                        echo "<i class='bx bx-user-circle connect'></i>";
                    }
                ?>
                </li>
            </ul>
        </nav>
    </header>

    <div class="sidebar">
        <ul>
            <li>
                <a class="underline" href="dashboard.php"> Dashboard</a>
            </li>
            <li>
                <a class="underline" href="users.php"> Users</a>
            </li>
            <li>
                <a class="underline" href="reservations.php">Reservations</a>
            </li>
            <li>
                <a class="underline" href="destinations.php">Destinations</a>
            </li>         
    </div>

    <script>
  const toggleButton = document.getElementById("theme-toggle");

  toggleButton.addEventListener("click", () => {
    document.body.classList.toggle("dark");
  });
</script>
