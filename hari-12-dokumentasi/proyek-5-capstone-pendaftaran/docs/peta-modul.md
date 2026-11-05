# Peta Modul & Alur Sistem

## 1. Pemetaan Berkas Proyek

| Berkas | Tanggung Jawab | Fungsi Utama |
|---|---|---|
| `config/database.php` | Koneksi database PDO | `getConnection()` |
| `src/bootstrap.php` | Inisialisasi sesi, konfigurasi, error handler | - |
| `src/helpers.php` | Utilitas umum, sanitasi, CSRF, flash message | `e()`, `redirect()`, `tokenCsrf()`, `cekCsrf()`, `setFlash()`, `ambilFlash()` |
| `src/pendaftar.php` | Pengolahan data pendaftar & transaksi kuota | `validasiPendaftar()`, `tambahPendaftar()`, `ambilSemuaPendaftar()`, `ambilPendaftarById()`, `daftarkanDenganKuota()` |
| `src/auth.php` | Autentikasi dan otorisasi sesi admin | `cariAdmin()`, `prosesLogin()`, `wajibLogin()`, `logout()` |
| `src/validasi.php` | Logika murni untuk validasi & helper teruji | `validNoHp()`, `hitungSisaKuota()`, `formatNomorBukti()` |
| `public/*.php` | Antarmuka pengguna (Controller + View) | - |

---

## 2. Spesifikasi Parameter & Output Fungsi Utama

| Fungsi | Parameter (Tipe & Batasan) | Nilai Kembalian | Kasus Khusus / Exception |
|---|---|---|---|
| `validasiPendaftar` | `array $input`, `PDO $pdo`, `?int $idUbah` | `array{data: array, galat: array}` | `$idUbah` bernilai `null` saat tambah data baru |
| `ambilPendaftarById` | `PDO $pdo`, `int $id (>= 1)` | `?array` | Mengembalikan `null` bila data tidak ditemukan |
| `daftarkanDenganKuota` | `PDO $pdo`, `array $data` | `void` | Melempar `KuotaPenuhException` jika kuota habis |
| `prosesLogin` | `PDO $pdo`, `string $username`, `string $sandi` | `bool` | Mengembalikan `false` bila username/sandi salah |
| `hitungSisaKuota` | `int $kuota`, `int $terisi` | `int` | Tidak pernah bernilai negatif (`max(0, ...)`)|

---

## 3. Diagram Alur Sistem (Mermaid)

### Alur Pendaftaran Peserta
```mermaid
flowchart TD
  A[Isi Form Pendaftaran] --> B{Validasi Server Valid?}
  B -- Tidak --> C[Tampilkan Pesan Galat]
  B -- Ya --> D{Kuota Kelas Tersedia?}
  D -- Tidak --> C
  D -- Ya --> E[Simpan ke DB & Cetak Bukti PDF]