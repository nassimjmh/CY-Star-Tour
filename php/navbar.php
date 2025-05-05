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
            <button id="theme-toggle" aria-label="Changer le thème">💡</button>
        </li>

        <?php

        if (isset($_SESSION['email'])) {

            echo "<li><i class='bx bx-shopping-bag'></i></li>";
        }
        ?>

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

  // Fonction pour obtenir un cookie
  function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  // Vérifier le cookie pour le mode sombre et appliquer le thème
  const darkMode = getCookie('darkMode');
  if (darkMode === 'enabled') {
    document.body.classList.add('dark');
  }

  const button = document.getElementById('theme-toggle');
  button.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    if (document.body.classList.contains('dark')) {
      setCookie('darkMode', 'enabled', 365); // Sauvegarder le mode sombre pour 1 an
    } else {
      setCookie('darkMode', 'disabled', 365); // Sauvegarder le mode clair pour 1 an
    }
  });
</script>
