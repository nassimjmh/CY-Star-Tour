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

        <?php if (isset($_SESSION['email'])): ?>
            <style>
                .cart-container {
                    position: relative;
                    display: inline-block;
                }

                .cart-icon {
                    font-size: 24px;
                    cursor: pointer;
                    position: relative;
                }

                .cart-count {
                    position: absolute;
                    top: -8px;
                    right: -10px;
                    background: red;
                    color: white;
                    font-size: 12px;
                    padding: 2px 6px;
                    border-radius: 50%;
                }

                .dropdown-cart {
                    display: none;
                    position: absolute;
                    right: 0;
                    top: 35px;
                    background-color: white;
                    min-width: 200px;
                    box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
                    z-index: 100;
                    border-radius: 8px;
                    padding: 10px;
                }

                .cart-container:hover .dropdown-cart {
                    display: block;
                }

                .dropdown-cart p {
                    margin: 0;
                    font-size: 14px;
                    color: #333;
                }

                .dropdown-cart hr {
                    margin: 5px 0;
                }
            </style>

            <?php
            include '../php/cart.php';
            list($cartItems, $cartCount) = getCartItems();
            ?>


            <li class="cart-container">
                <i class='bx bx-shopping-bag cart-icon'></i>
                <span class="cart-count"><?php echo $cartCount; ?></span>

                <div class="dropdown-cart">
                    <p>Your space bag:</p>
                    <hr>
                    <?php if ($cartCount > 0): ?>
                        <?php foreach ($cartItems as $item): ?>
                            <p><?php echo htmlspecialchars($item['planet']); ?> - <?php echo htmlspecialchars($item['nbpeople']); ?> people</p>


                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Your cart is empty.</p>
                    <?php endif; ?>
                </div>
            </li>

        <?php endif; ?>


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
