<?php
$host = 'localhost';
$user = 'root'; // Adjust if needed
$pass = ''; // Adjust if needed
$db   = 'edutrack';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    // Send 500 error if DB fails
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}
?>
