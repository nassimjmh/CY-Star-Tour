
<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo-footer" >
            <ul class="payment-logos">
                <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/american-express.svg" alt="amex"></il>
                <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/cartes-bancaires.svg" alt="cartebleue"></il>
                <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/apm/paypal.svg" alt="paypal"></il>
                <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/mastercard.svg" alt="mastercard"></il>
                <il><img src="https://raw.githubusercontent.com/datatrans/payment-logos/bb609198fb0b8f30b9f2b6682b1c0a765225b2c1/assets/cards/visa.svg" alt="visa"></il>
                <il><img src="../images/bitcoin.svg" alt="bitcoin"></il>
            </ul>
        </div>
        <div class="footer-section links">
            <h3>Useful Links</h3>
            <ul>
                <li><a href="../index.html">Home</a></li>
                <li><a href="../html/book.html">Destinations</a></li>
                <li><a href="../html/aboutus.html">About us</a></li>
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                    echo '<li><a href="admin/dashboard.php">Admin control panel</a></li>';
                }
                ?>
                <li><a href="profil.php">Contact (profile page)</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <h3>Contact</h3>
            <p>Email: contact@startour.com</p>
            <p>Phone: +0 831 576 989</p>
            <p>Address: 49.035, 2.0698 Earth</p>
        </div>
        <div class="footer-section social">
            <h3>Follow Us</h3>
            <ul>
                <li><a href="#">Bluesky</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">LinkedIn</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 4090 CY StarTour. All rights reserved.</p>
    </div>
</footer>

