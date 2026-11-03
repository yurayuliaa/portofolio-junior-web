# Analisis Kebutuhan Sistem (Sprint 0)
**Proyek:** Sistem Pendaftaran Pelatihan Daring  
**Modul:** Capstone Project - Hari 9  

---

## 1. Peran Pengguna (Actors)

| Actor | Peran & Hak Akses |
| :--- | :--- |
| **Peserta** | Pengguna publik yang mengakses formulir untuk mendaftar pelatihan, melihat daftar kelas yang tersedia, dan mencetak bukti pendaftaran. |
| **Admin** | Pengelola sistem yang memiliki hak penuh untuk mengelola data pendaftar (CRUD), memantau kuota kelas, serta mengelola akun administrator. |

---

## 2. Fitur Utama (Minimum Viable Product - MVP)

1. **Pendaftaran Peserta (Public Form)**
   - Formulir pendaftaran dengan input: Nama Lengkap, Email (Unik), Nomor HP (format 08xx), Alamat, dan Pilihan Kelas.
   - Validasi sisi server (*Server-side Validation*) untuk memastikan data lengkap dan valid.
   - Proteksi XSS pada tampilan dan pencegahan SQL Injection pada query database.

2. **Manajemen Pendaftar (Admin Management)**
   - Tampilan daftar pendaftar lengkap dengan nama kelas (menggunakan query `JOIN`).
   - Fitur filter pencarian cepat berdasarkan nama atau email.
   - Paginasi data (10 data per halaman) untuk menjaga performa rendering.
   - Fitur ubah data (*Update*) pendaftar.
   - Fitur hapus data (*Delete*) aman berbasis metode `POST` dengan proteksi token CSRF.

3. **Manajemen Kelas & Kuota (Foundational)**
   - Relasi 1-ke-Banyak (1-N) antara tabel `kelas` dan `pendaftar`.
   - Informasi sisa kuota pada dropdown pilihan kelas.

---

## 3. Fitur Tambahan (Rencana Sprint Berikutnya)

- **Sprint 1 (Hari 10):** Integrasi UI Bootstrap 5, ekspor bukti pendaftaran ke format PDF (Dompdf/TCPDF), dan SweetAlert2.
- **Sprint 2 (Hari 11):** Autentikasi Admin (Login/Logout dengan `password_hash`), pembatasan otomatis kuota kelas.

---

## 4. Batasan Teknologi (Constraints)

- **Language & Runtime:** PHP 8.x (Strict Types Enabled: `declare(strict_types=1)`).
- **Database Engine:** MySQL / MariaDB (InnoDB Engine, utf8mb4 charset).
- **Database Driver:** PDO (PHP Data Objects) dengan Prepared Statement wajib.
- **Architecture:** Pure PHP Native tanpa framework (Laravel/CodeIgniter), mengikuti standar struktur folder modular dan standar kode PSR-12.