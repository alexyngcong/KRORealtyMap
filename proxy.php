<?php
header('Content-Type: application/json');

if (!isset($_GET['type']) || $_GET['type'] !== 'nominatim' || !isset($_GET['q'])) {
    echo json_encode([]);
    exit;
}

$query = urlencode($_GET['q']);
$url = "https://nominatim.openstreetmap.org/search?q={$query}&format=json&polygon_geojson=1&limit=5";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Kairo-Map/1.0 (contact@kairo.com)'); // Set a proper user agent
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>