# Capstone Project: Sistem Pendaftaran Pelatihan

Aplikasi web CRUD pendaftaran pelatihan berbasis PHP Native dan MySQL dengan menerapkan praktik keamanan standar (Prepared Statement, CSRF Protection, Sanitasi XSS, dan PRG Pattern).

## Fitur Utama
- CRUD Pendaftar Pelatihan (Tambah, Lihat, Ubah, Hapus)
- Paginasi & Filter Pencarian Data
- Proteksi CSRF & Sanitasi XSS (`e()`)
- Penanganan SQL Injection menggunakan PDO Prepared Statement

## Cara Instalasi
1. Clone / download repositori ini ke folder `htdocs`.
2. Impor `database/skema.sql` ke phpMyAdmin (`db_pelatihan`).
3. Impor `database/data_contoh.sql` untuk memasukkan data awal.
4. Salin `config/config.contoh.php` menjadi `config/config.php`.
5. Sesuaikan kredensial database di `config/config.php`.
6. Akses melalui browser: `http://localhost/proyek-5-capstone-pendaftaran/public/index.php`