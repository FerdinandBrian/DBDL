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

$query = "
    SELECT 
        tagihan,
        nominal,
        status,
        jatuh_tempo
    FROM keuangan
    WHERE mahasiswa_nrp = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(['success' => true, 'data' => $data]);
?>
