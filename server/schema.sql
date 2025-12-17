-- Sample schema (adjust column names/types to match your project)
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS keuangan;
DROP TABLE IF EXISTS nilai;
DROP TABLE IF EXISTS krs;
DROP TABLE IF EXISTS kelas;
DROP TABLE IF EXISTS mata_kuliah;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS mahasiswa;
DROP TABLE IF EXISTS dosen;
DROP TABLE IF EXISTS admin;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nrp VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('mahasiswa','dosen','admin') NOT NULL,
  redirect VARCHAR(255),
  UNIQUE KEY (nrp, role)
);

-- Example mahasiswa table
CREATE TABLE mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nrp VARCHAR(50) NOT NULL UNIQUE,
  nama VARCHAR(255),
  prodi VARCHAR(100),
  angkatan VARCHAR(10)
);

-- Example dosen table
CREATE TABLE dosen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nrp VARCHAR(50) NOT NULL UNIQUE,
  nama VARCHAR(255),
  departemen VARCHAR(100)
);

-- Example admin table
CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nrp VARCHAR(50) NOT NULL UNIQUE,
  nama VARCHAR(255)
);

-- Mata Kuliah
CREATE TABLE mata_kuliah (
  kode_mk VARCHAR(10) PRIMARY KEY,
  nama_mk VARCHAR(100) NOT NULL,
  sks INT NOT NULL,
  semester INT NOT NULL
);

-- Kelas (Jadwal)
CREATE TABLE kelas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_mk VARCHAR(10),
  nama_kelas VARCHAR(5),
  dosen_nrp VARCHAR(50),
  hari VARCHAR(20),
  jam_mulai TIME,
  jam_selesai TIME,
  ruang VARCHAR(20),
  FOREIGN KEY (kode_mk) REFERENCES mata_kuliah(kode_mk),
  FOREIGN KEY (dosen_nrp) REFERENCES dosen(nrp)
);

-- KRS (DKBS)
CREATE TABLE krs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_nrp VARCHAR(50),
  kelas_id INT,
  status VARCHAR(20) DEFAULT 'Diambil',
  FOREIGN KEY (mahasiswa_nrp) REFERENCES mahasiswa(nrp),
  FOREIGN KEY (kelas_id) REFERENCES kelas(id)
);

-- Nilai
CREATE TABLE nilai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  krs_id INT,
  tugas FLOAT,
  uts FLOAT,
  uas FLOAT,
  nilai_akhir FLOAT,
  grade VARCHAR(2),
  FOREIGN KEY (krs_id) REFERENCES krs(id)
);

-- Keuangan
CREATE TABLE keuangan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_nrp VARCHAR(50),
  tagihan VARCHAR(100),
  nominal DECIMAL(15,2),
  status VARCHAR(20), -- Lunas, Belum Lunas
  jatuh_tempo DATE,
  FOREIGN KEY (mahasiswa_nrp) REFERENCES mahasiswa(nrp)
);

SET FOREIGN_KEY_CHECKS = 1;
