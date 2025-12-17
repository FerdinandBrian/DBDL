-- Data Awal (Seed Data)
-- Gunakan file ini jika Anda perlu mereset ulang database

-- 1. Reset Table
DELETE FROM users;
DELETE FROM mahasiswa;
DELETE FROM dosen;
DELETE FROM admin;

-- 2. Insert Users (Login)
-- Password disimpan sebagai plain text sesuai request (tidak aman untuk production)
INSERT INTO users (nrp, password, role) VALUES 
('2472021', 'ferdinand11@', 'mahasiswa'),
('0072201', 'juan123', 'dosen'),
('001001', 'bc123', 'admin');

-- 3. Insert Profiles
INSERT INTO mahasiswa (nrp, nama, prodi, angkatan) VALUES 
('2472021', 'Ferdinand Brian', 'Teknik Informatika', '2021');

INSERT INTO dosen (nrp, nama, departemen) VALUES 
('0072201', 'Juan, S.Kom., M.Kom.', 'Teknik Informatika');

INSERT INTO admin (nrp, nama) VALUES 
('001001', 'Budi Candra');
