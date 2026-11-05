USE db_pelatihan;

-- 1. Semua pendaftar urut nama A-Z
SELECT id, nama, email FROM pendaftar ORDER BY nama ASC;

-- 2. 5 pendaftar terbaru
SELECT id, nama, tgl_daftar FROM pendaftar ORDER BY tgl_daftar DESC, id DESC LIMIT 5;

-- 3. Nama yang mengandung kata "an"
SELECT id, nama FROM pendaftar WHERE nama LIKE '%an%';

-- 4. Gabungkan nama pendaftar dengan nama kelasnya (INNER JOIN)
SELECT p.nama, k.nama_kelas 
FROM pendaftar p 
JOIN kelas k ON k.id = p.kelas_id;

-- 5. Hitung jumlah pendaftar di setiap kelas (GROUP BY)
SELECT k.nama_kelas, COUNT(p.id) AS jumlah
FROM kelas k 
LEFT JOIN pendaftar p ON p.kelas_id = k.id
GROUP BY k.id, k.nama_kelas;

-- 6. Cari kelas yang belum ada pendaftarnya
SELECT k.id, k.nama_kelas
FROM kelas k 
LEFT JOIN pendaftar p ON p.kelas_id = k.id
WHERE p.id IS NULL;

-- 7. Ubah nomor HP pendaftar dengan ID 2
UPDATE pendaftar SET no_hp = '081299990000' WHERE id = 2;

-- 8. Hapus pendaftar dengan ID 8
DELETE FROM pendaftar WHERE id = 8;