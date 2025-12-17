<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require 'db.php';

$input = json_decode(file_get_contents('php://input'), true);

$nrp = $input['nrp'] ?? '';
$password = $input['password'] ?? '';
$role = $input['role'] ?? '';

if (!$nrp || !$password || !$role) {
    echo json_encode(['success' => false, 'message' => 'nrp, password, and role required']);
    exit();
}

// Prepare statement to prevent SQL Injection
$stmt = $conn->prepare("SELECT nrp, password, role, redirect FROM users WHERE nrp = ? AND role = ? LIMIT 1");
$stmt->bind_param("ss", $nrp, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Kombinasi NRP dan Role tidak ditemukan']);
    exit();
}

$user = $result->fetch_assoc();

// Plain text password check as requested
if ($password === $user['password']) {
    echo json_encode([
        'success' => true,
        'nrp' => $user['nrp'],
        'role' => $user['role'],
        'redirect' => $user['redirect'] // Remove default '/' so JS handles the routing
    ]);
} else {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Password salah']);
}
?>
