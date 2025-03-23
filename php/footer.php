
<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <img src="https://fontmeme.com/permalink/250208/ebb188615e03ca690752fd1065d0303e.png" alt="Logo-footer" >
            <ul class="payment-logos">
                <il><img src="https://github.com/slaterjohn/payment-logos/blob/master/Rounded%20Corners/PNG/small/american-express@2x.png?raw=true" alt="amex"></il>
                <il><img src="https://github.com/slaterjohn/payment-logos/blob/master/Rounded%20Corners/PNG/medium/cb@2x.png?raw=true" alt="cartebleue"></il>
                <il><img src="https://github.com/slaterjohn/payment-logos/blob/master/Rounded%20Corners/PNG/small/paypal@2x.png?raw=true" alt="paypal"></il>
                <il><img src="https://github.com/slaterjohn/payment-logos/blob/master/Rounded%20Corners/PNG/small/mastercard@2x.png?raw=true" alt="mastercard"></il>
                <il><img src="https://github.com/slaterjohn/payment-logos/blob/master/Rounded%20Corners/PNG/small/visa@2x.png?raw=true" alt="visa"></il>
                <il><img src="https://github.com/slaterjohn/payment-logos/blob/master/Rounded%20Corners/PNG/medium/bitcoin-2@2x.png?raw=true" alt="bitcoin"></il>
            </ul>
        </div>
        <div class="footer-section links">
            <h3>Useful Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="book.php">Destinations</a></li>
                <li><a href="aboutus.php">About us</a></li>
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
            <p>Email: contact@startour.cy</p>
            <p>Phone: +0 831 576 989</p>
            <p>Address: 49.035, 2.0698 CY</p>
        </div>
        <div class="footer-section social">
            <h3>Follow Us</h3>
            <ul>
                <li><a href="https://bsky.app/">Bluesky</a></li>
                <li><a href="https://twitter.com/">Twitter</a></li>
                <li><a href="https://www.instagram.com/">Instagram</a></li>
                <li><a href="https://www.linkedin.com/">LinkedIn</a></li>
            </ul>
        </div>
    </div>
</footer>

