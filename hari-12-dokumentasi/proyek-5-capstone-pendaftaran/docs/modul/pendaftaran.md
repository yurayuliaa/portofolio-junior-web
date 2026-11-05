# Modul Pendaftar

| Bagian                | Isi                                                                                                                                                                                       |
| --------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **ID Modul / Berkas** | `MOD-PND-001` / `src/pendaftar.php`                                                                                                                                                       |
| **Versi & Status**    | `1.0.1` / Aktif                                                                                                                                                                           |
| **Penulis & Tanggal** | Yulia Rahma Qatrunnada Qurratuain / 4 November 2026                                                                                                                                       |
| **Kegunaan**          | Pengolahan data pendaftar pelatihan, query database PDO, dan validasi kuota kelas                                                                                                         |
| **Dependensi**        | `config/database.php`, `src/helpers.php`                                                                                                                                                  |
| **Fungsi Publik**     | `validasiPendaftar()`, `tambahPendaftar()`, `ambilSemuaPendaftar()`, `ambilPendaftarById()`, `daftarkanDenganKuota()`                                                                     |
| **Catatan Keamanan**  | Menggunakan _prepared statements_ (PDO) untuk mencegah SQL Injection, transaksi database (`beginTransaction`/`commit`), dan kuncian baris (`FOR UPDATE`) untuk integritas kuota serentak. |
| **Contoh Pemakaian**  | `$pendaftar = ambilSemuaPendaftar($pdo);`                                                                                                                                                 |

---

## Riwayat Revisi

| Versi   | Tanggal         | Perubahan                                                | Penulis |
| ------- | --------------- | -------------------------------------------------------- | ------- |
| `1.0.0` | 2 November 2026 | Operasi CRUD dasar pendaftar dan validasi input          | Rahma   |
| `1.0.1` | 4 November 2026 | Integrasi transaksi kuota kelas dan dokumentasi DocBlock | Rahma   |
