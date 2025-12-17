
DELETE FROM users;
DELETE FROM mahasiswa;
DELETE FROM dosen;
DELETE FROM admin;

INSERT INTO users (nrp, password, role) VALUES 
('2472021', 'ferdinand11@', 'mahasiswa'),
('0072201', 'juan123', 'dosen'),
('001001', 'bc123', 'admin');

INSERT INTO mahasiswa (nrp, nama, prodi, angkatan) VALUES 
('2472021', 'Ferdinand Brian', 'Teknik Informatika', '2021');

INSERT INTO dosen (nrp, nama, departemen) VALUES 
('0072201', 'Juan, S.Kom., M.Kom.', 'Teknik Informatika');

INSERT INTO admin (nrp, nama) VALUES 
('001001', 'Budi Candra');

-- Data Mata Kuliah
INSERT INTO mata_kuliah (kode_mk, nama_mk, sks, semester) VALUES 
('IF101', 'Pemrograman Web', 3, 3),
('IF102', 'Basis Data Lanjut', 4, 3),
('IF103', 'Algoritma Pemrograman', 4, 1);

-- Data Kelas
INSERT INTO kelas (kode_mk, nama_kelas, dosen_nrp, hari, jam_mulai, jam_selesai, ruang) VALUES 
('IF101', 'A', '0072201', 'Senin', '07:30:00', '10:00:00', 'Lab 1'),
('IF102', 'B', '0072201', 'Selasa', '10:30:00', '13:30:00', 'Lab 2');

-- Data KRS (DKBS) untuk Ferdinand (2472021)
INSERT INTO krs (mahasiswa_nrp, kelas_id, status) VALUES 
('2472021', 1, 'Diambil'),
('2472021', 2, 'Diambil');

-- Data Nilai
INSERT INTO nilai (krs_id, tugas, uts, uas, nilai_akhir, grade) VALUES 
(1, 85, 80, 88, 85, 'A'),
(2, 90, 85, 92, 90, 'A');

-- Data Keuangan
INSERT INTO keuangan (mahasiswa_nrp, tagihan, nominal, status, jatuh_tempo) VALUES 
('2472021', 'SPP Semester Ganjil', 5000000, 'Lunas', '2025-12-01'),
('2472021', 'Iuran Kemahasiswaan', 150000, 'Belum Lunas', '2025-12-20');
