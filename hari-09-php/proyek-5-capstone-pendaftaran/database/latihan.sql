-- Lab 1 - Latihan SQL (jalankan setelah skema.sql dan data-contoh.sql)
-- Jalankan satu per satu di tab SQL phpMyAdmin supaya hasil tiap soal terlihat.
USE db_pelatihan;

-- 1. Semua pendaftar diurutkan nama A-Z
SELECT id, nama, email FROM pendaftar ORDER BY nama ASC;

-- 2. 5 pendaftar terbaru
SELECT id, nama, tgl_daftar FROM pendaftar ORDER BY id DESC LIMIT 5;

-- 3. Pendaftar yang namanya mengandung "an"
SELECT id, nama FROM pendaftar WHERE nama LIKE '%an%' ORDER BY nama;

-- 4. Nama pendaftar beserta nama kelas (JOIN)
SELECT p.nama, k.nama_kelas
FROM pendaftar p
JOIN kelas k ON k.id = p.kelas_id
ORDER BY k.nama_kelas, p.nama;

-- 5. Jumlah pendaftar per kelas (GROUP BY)
SELECT k.nama_kelas, COUNT(p.id) AS jumlah
FROM kelas k
LEFT JOIN pendaftar p ON p.kelas_id = k.id
GROUP BY k.id, k.nama_kelas;

-- 6. Kelas yang belum memiliki pendaftar (LEFT JOIN ... IS NULL)
SELECT k.id, k.nama_kelas
FROM kelas k
LEFT JOIN pendaftar p ON p.kelas_id = k.id
WHERE p.id IS NULL;

-- 7. Ubah nomor HP satu pendaftar (WAJIB pakai WHERE)
UPDATE pendaftar SET no_hp = '081111111111' WHERE id = 1;
SELECT id, nama, no_hp FROM pendaftar WHERE id = 1;

-- 8. Hapus satu pendaftar (WAJIB pakai WHERE)
DELETE FROM pendaftar WHERE id = 12;
SELECT COUNT(*) AS sisa_pendaftar FROM pendaftar;

-- 9. Email ganda -> ERROR 1062 Duplicate entry (diharapkan gagal)
INSERT INTO pendaftar (nama, email, no_hp, kelas_id)
VALUES ('Orang Lain', 'sari@contoh.com', '081200000000', 1);

-- 10. Hapus kelas yang masih punya pendaftar -> ERROR 1451 foreign key (diharapkan gagal)
DELETE FROM kelas WHERE id = 1;