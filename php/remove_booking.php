<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit();
}

$id = $_SESSION['id'];
$reservationId = $_GET['id'];

$file = '../json/data/booking.json';
$data = json_decode(file_get_contents($file), true);

if (isset($data[$reservationId]) && $data[$reservationId]['id'] == $id) {
    unset($data[$reservationId]); // supprime la réservation
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Booking not found or not yours']);
}
