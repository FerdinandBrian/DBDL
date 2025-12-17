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
        mk.nama_mk, 
        cl.nama_kelas, 
        cl.hari, 
        cl.jam_mulai, 
        cl.jam_selesai, 
        cl.ruang,
        d.nama as nama_dosen
    FROM krs k
    JOIN kelas cl ON k.kelas_id = cl.id
    JOIN mata_kuliah mk ON cl.kode_mk = mk.kode_mk
    JOIN dosen d ON cl.dosen_nrp = d.nrp
    WHERE k.mahasiswa_nrp = ?
    ORDER BY FIELD(cl.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')
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
