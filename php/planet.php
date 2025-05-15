<?php
session_start();
$selectedPlanet = $_SESSION['planet_data'];  

$file = '../json/destination/' . ucfirst($selectedPlanet) . '.json';

$planet = json_decode(file_get_contents($file), true);

echo json_encode($planet);
exit;
?>
