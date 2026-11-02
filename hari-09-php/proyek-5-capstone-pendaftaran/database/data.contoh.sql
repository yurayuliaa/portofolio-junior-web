-- Data contoh: 3 kelas (satu kelas sengaja tanpa pendaftar) dan 12 pendaftar
-- (lebih dari 10 supaya paginasi dapat diuji). Menimpa data lama pada kedua tabel.
USE db_pelatihan;

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE pendaftar;
TRUNCATE TABLE kelas;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO kelas (nama_kelas, kuota) VALUES
  ('Web Programming', 30),
  ('Desain Grafis', 25),
  ('Jaringan Komputer', 20);

INSERT INTO pendaftar (nama, email, no_hp, alamat, kelas_id) VALUES
  ('Sari Wulandari', 'sari@contoh.com', '081234567890', 'Surakarta', 1),
  ('Budi Santoso', 'budi@contoh.com', '081234567891', 'Denpasar', 1),
  ('Citra Lestari', 'citra@contoh.com', '081234567892', 'Gianyar', 2),
  ('Dewi Anggraini', 'dewi@contoh.com', '081234567893', 'Ubud', 1),
  ('Eka Prasetyo', 'eka@contoh.com', '081234567894', NULL, 2),
  ('Fajar Ramadhan', 'fajar@contoh.com', '081234567895', 'Tabanan', 1),
  ('Gita Permata', 'gita@contoh.com', '081234567896', 'Singaraja', 2),
  ('Hadi Nugroho', 'hadi@contoh.com', '081234567897', 'Negara', 1),
  ('Indah Kusuma', 'indah@contoh.com', '081234567898', 'Klungkung', 2),
  ('Joko Susanto', 'joko@contoh.com', '081234567899', 'Bangli', 1),
  ('Kiki Handayani', 'kiki@contoh.com', '081234567800', 'Karangasem', 2),
  ('Lina Marlina', 'lina@contoh.com', '081234567801', 'Badung', 1);