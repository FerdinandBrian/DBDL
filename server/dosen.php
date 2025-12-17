<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require 'db.php';

$nrp = $_GET['nrp'] ?? '';

if (!$nrp) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'nrp required']);
    exit();
}

$stmt = $conn->prepare("SELECT nrp, nama, departemen FROM dosen WHERE nrp = ? LIMIT 1");
$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Dosen tidak ditemukan']);
} else {
    echo json_encode(['success' => true, 'data' => $result->fetch_assoc()]);
}
?>
