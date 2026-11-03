CREATE DATABASE IF NOT EXISTS db_pelatihan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_pelatihan;

-- 1. Tabel Kelas
CREATE TABLE IF NOT EXISTS kelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(100) NOT NULL,
    kuota INT NOT NULL DEFAULT 30
) ENGINE=InnoDB;

-- 2. Tabel Pendaftar
CREATE TABLE IF NOT EXISTS pendaftar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT NULL,
    kelas_id INT NOT NULL,
    tgl_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pendaftar_kelas FOREIGN KEY (kelas_id) REFERENCES kelas (id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 3. Tabel Admin (Deliverable PBL Sprint 0)
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Indeks Tambahan
CREATE INDEX idx_pendaftar_nama ON pendaftar (nama);