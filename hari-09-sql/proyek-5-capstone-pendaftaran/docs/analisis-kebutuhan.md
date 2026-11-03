# Analisis Kebutuhan Sistem (PBL Sprint 0)

## 1. Pengguna Sistem (Actor)
* **Peserta**: Mengisi form pendaftaran pelatihan.
* **Admin**: Mengelola data pendaftar (CRUD), mencari data, dan melihat paginasi.

## 2. Fitur Utama (MVP)
* Pendaftaran peserta baru dengan validasi input (nama, email unik, no HP, pilihan kelas).
* Menampilkan daftar pendaftar dengan paginasi (5 data per halaman).
* Filter pencarian pendaftar berdasarkan nama atau email.
* Fitur ubah dan hapus data pendaftar berbasis POST + CSRF Protection.