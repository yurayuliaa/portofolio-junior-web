USE db_pelatihan;

INSERT INTO kelas (nama_kelas, kuota) VALUES
('Web Programming', 30), 
('Desain Grafis', 25), 
('Jaringan Komputer', 20);

INSERT INTO pendaftar (nama, email, no_hp, alamat, kelas_id) VALUES
('Andi Pratama',      'andi@contoh.com',    '081234567801', 'Surakarta', 1),
('Budi Santoso',      'budi@contoh.com',    '081234567802', 'Sukoharjo', 1),
('Citra Ayu',         'citra@contoh.com',   '081234567803', 'Klaten',    2),
('Dewi Lestari',      'dewi@contoh.com',    '081234567804', 'Boyolali',  2),
('Rizal Firmansyah',  'rizal@contoh.com',   '081234567805', 'Surakarta', 1),
('Putri Handayani',   'putri@contoh.com',   '081234567806', 'Karanganyar', 2),
('Bayu Ananta',       'bayu@contoh.com',    '081234567807', 'Surakarta', 1),
('Sari Wulandari',    'sari@contoh.com',    '081234567808', 'Sragen',    2);