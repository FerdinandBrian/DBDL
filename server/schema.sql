-- Sample schema (adjust column names/types to match your project)

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
