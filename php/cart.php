<?php

function getCartItems() {
    if (isset($_SESSION['email']) && filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
        $cartItems = [];
        $cartCount = 0;

        $userEmail = $_SESSION['email'];
        $filePath = '../json/data/cart.json';

        if (file_exists($filePath) && is_readable($filePath)) {

            $allBookings = json_decode(file_get_contents($filePath), true);

            if ($allBookings === null) {
                return [[], 0];
            }



            foreach ($allBookings as $booking) {
                if (isset($booking['email']) && $booking['email'] === $userEmail) {
                    $cartItems[] = $booking;
                }
            }

            $cartCount = count($cartItems);
        }

        else {
            return [[], 0];
        }

        return [$cartItems, $cartCount];
    }

    return [[], 0];
}
