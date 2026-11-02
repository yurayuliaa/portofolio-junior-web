-- Skema Proyek 5 - Sistem Pendaftaran Pelatihan
-- Aman dijalankan berulang kali (tidak menghapus data yang sudah ada).
-- Impor lewat phpMyAdmin: tab Import, atau tab SQL.

CREATE DATABASE IF NOT EXISTS db_pelatihan
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_pelatihan;

CREATE TABLE IF NOT EXISTS kelas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_kelas VARCHAR(100) NOT NULL,
  kuota INT NOT NULL DEFAULT 30
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS pendaftar (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  no_hp VARCHAR(20) NOT NULL,
  alamat TEXT NULL,
  kelas_id INT NOT NULL,
  tgl_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_pendaftar_nama (nama),
  CONSTRAINT fk_pendaftar_kelas FOREIGN KEY (kelas_id) REFERENCES kelas(id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Rancangan untuk Hari 11 (login admin). Kolom password_hash menyimpan hasil password_hash().
CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;