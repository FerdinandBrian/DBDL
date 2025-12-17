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
        mk.kode_mk,
        mk.nama_mk, 
        mk.sks,
        cl.nama_kelas,
        n.tugas,
        n.uts,
        n.uas,
        n.nilai_akhir,
        n.grade
    FROM nilai n
    JOIN krs k ON n.krs_id = k.id
    JOIN kelas cl ON k.kelas_id = cl.id
    JOIN mata_kuliah mk ON cl.kode_mk = mk.kode_mk
    WHERE k.mahasiswa_nrp = ?
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
