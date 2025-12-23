<?php
// Direct test of login endpoint
$url = 'http://localhost:8000/api/login';
$data = [
    'nrp' => '2472021',
    'password' => 'ferdinand11@',
    'role' => 'mahasiswa'
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response:\n";
echo $response . "\n";

$json = json_decode($response, true);
if ($json) {
    echo "\nParsed JSON:\n";
    print_r($json);
}
