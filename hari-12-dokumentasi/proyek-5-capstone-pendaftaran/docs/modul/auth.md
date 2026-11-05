# Modul Auth

| Bagian | Isi |
|---|---|
| **ID Modul / Berkas** | `MOD-AUT-001` / `src/auth.php` |
| **Versi & Status** | `1.0.1` / Aktif |
| **Penulis & Tanggal** | Yulia Rahma Qatrunnada Qurratuain / 4 November 2026 |
| **Kegunaan** | Autentikasi dan otorisasi sesi admin berbasis `password_hash` |
| **Dependensi** | `config/database.php`, `src/helpers.php` |
| **Fungsi Publik** | `cariAdmin()`, `prosesLogin()`, `wajibLogin()`, `logout()` |
| **Catatan Keamanan** | Regenerasi ID sesi saat login (`session_regenerate_id`), penanganan pesan galat umum untuk cegah enumerasi user, dan pembersihan penuh cookie sesi saat logout. |
| **Contoh Pemakaian** | `wajibLogin();` di bagian paling atas halaman admin (`public/index.php`) |

---

## Riwayat Revisi

| Versi | Tanggal | Perubahan | Penulis |
|---|---|---|---|
| `1.0.0` | 3 November 2026 | Implementasi awal login admin, `wajibLogin()`, dan `logout()` | Rahma |
| `1.0.1` | 4 November 2026 | Penambahan header modul dan DocBlock PHPDoc lengkap | Rahma |