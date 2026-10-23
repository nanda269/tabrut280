-- Database SIM Mahasiswa UMB
CREATE DATABASE IF NOT EXISTS db_sistemmahasiswa;
USE db_sistemmahasiswa;

-- Tabel Fakultas
CREATE TABLE IF NOT EXISTS fakultas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_fakultas VARCHAR(100) NOT NULL
);

-- Tabel Program Studi
CREATE TABLE IF NOT EXISTS prodi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_prodi VARCHAR(100) NOT NULL,
    id_fakultas INT,
    FOREIGN KEY (id_fakultas) REFERENCES fakultas(id) ON DELETE CASCADE
);

-- Tabel Mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    npm VARCHAR(20) PRIMARY KEY,
    nama_mahasiswa VARCHAR(150) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tempat_lahir VARCHAR(100),
    tanggal_lahir DATE,
    tanggal_masuk DATE,
    alamat TEXT,
    password VARCHAR(255) NOT NULL,
    id_prodi INT,
    FOREIGN KEY (id_prodi) REFERENCES prodi(id) ON DELETE SET NULL
);

-- Tabel Role
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_role VARCHAR(50) NOT NULL
);

-- Tabel Users (Admin/Staff)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100),
    role_id INT,
    status ENUM('Aktif', 'Nonaktif') DEFAULT 'Aktif',
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Tabel Audit Log
CREATE TABLE IF NOT EXISTS audit_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Insert Data Awal
INSERT INTO fakultas (nama_fakultas) VALUES ('Teknik'), ('Ekonomi'), ('Hukum');
INSERT INTO prodi (nama_prodi, id_fakultas) VALUES ('Teknik Informatika', 1), ('Sistem Informasi', 1), ('Akuntansi', 2);

INSERT INTO roles (nama_role) VALUES ('Admin'), ('Operator');

-- Default password: admin123 (hashed)
INSERT INTO users (username, password, nama_lengkap, role_id) 
VALUES ('admin', '$2y$10$wuRTpec.Kvk1S9S/GEcSe.wgyJ2osk9XrTdpXdCIwnnRxynKlmGru', 'Admin SIM Mahasiswa UMB', 1);

-- Contoh Mahasiswa
INSERT INTO mahasiswa (npm, nama_mahasiswa, jenis_kelamin, tempat_lahir, tanggal_lahir, tanggal_masuk, alamat, password, id_prodi)
VALUES ('2101001', 'Budi Santoso', 'Laki-laki', 'Bengkulu', '2002-05-10', '2021-09-01', 'Jl. Merdeka No. 1', '$2y$10$wuRTpec.Kvk1S9S/GEcSe.wgyJ2osk9XrTdpXdCIwnnRxynKlmGru', 1);
