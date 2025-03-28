<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarPay - Secure Payment</title>
    <link rel="stylesheet" href="../css/card.css">
</head>
<body>

<div class="container">
    <h1> StarPay - Secure Payment</h1>
    <form action="card.php" method="POST">
        <div class="form-group">
            <label for="card_holder">Cardholder Name:</label>
            <input type="text" name="card_holder" id="card_holder" placeholder="John Doe" required>
        </div>

        <div class="form-group">
            <label for="card_number">Card Number:</label>
            <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456" required>
        </div>

        <div class="form-group">
            <label for="expiry_date">Expiration Date (MM/YY):</label>
            <input type="text" name="expiry_date" id="expiry_date" placeholder="12/26" required>
        </div>

        <div class="form-group">
            <label for="cvv">Security Code (CVV):</label>
            <input type="text" name="cvv" id="cvv" placeholder="123" required>
        </div>

        <button type="submit">Pay Now</button>
    </form>
</div>

<p class="help-message">If you experience any issues, contact us at support@startour.cy</p>

</body>
</html>
