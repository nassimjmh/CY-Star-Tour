
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
        <li>
        <button id="theme-toggle" aria-label="Changer le thème">💡</button>
        </li>
        <li class="research">
            <a href="book.php"><i class='bx bx-search research'></i></a>
        </li>

        <li class="cart-icon">
            <button id="cart-toggle" aria-label="Voir le panier"><i class='bx bxs-shopping-bag-alt'></i> <span id="cart-count">0</span></button>
            <div id="cart-dropdown" class="cart-dropdown hidden">
                <p class="empty-msg">Your space shopping bag is empty</p>
                <ul id="cart-items"></ul>
                <p>Total : <span id="cart-total">0</span> ₴</p>
            </div>
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

<script>
  const button = document.getElementById('theme-toggle');
  button.addEventListener('click', () => {
    document.body.classList.toggle('dark');
  });

  document.addEventListener('DOMContentLoaded', () => {
      const cartToggle = document.getElementById('cart-toggle');
      const cartDropdown = document.getElementById('cart-dropdown');
      const cartItems = document.getElementById('cart-items');
      const cartTotal = document.getElementById('cart-total');
      const cartCount = document.getElementById('cart-count');
      const emptyMsg = document.querySelector('.empty-msg');

      const cart = [];

      cartToggle.addEventListener('click', () => {
          cartDropdown.classList.toggle('hidden');
      });

      // Fermer si on clique en dehors
      document.addEventListener('click', (e) => {
          if (!cartToggle.contains(e.target) && !cartDropdown.contains(e.target)) {
              cartDropdown.classList.add('hidden');
          }
      });

      function updateCartDisplay() {
          cartItems.innerHTML = '';
          let total = 0;

          if (cart.length === 0) {
              emptyMsg.style.display = 'block';
          } else {
              emptyMsg.style.display = 'none';
              cart.forEach((item) => {
                  const li = document.createElement('li');
                  li.innerHTML = `${item.name} <span>${item.price.toFixed(2)}₴</span>`;
                  cartItems.appendChild(li);
                  total += item.price;
              });
          }

          cartTotal.textContent = total.toFixed(2);
          cartCount.textContent = cart.length;
      }

      // Fonction publique pour ajouter un article au panier
      window.addToCart = function (name, price) {
          cart.push({ name, price });
          updateCartDisplay();
      };

      // Exemple de test à activer si besoin :
      // addToCart("Ticket Paris", 199.99);
      // addToCart("Voyage Mars", 499.00);
  });



</script>
