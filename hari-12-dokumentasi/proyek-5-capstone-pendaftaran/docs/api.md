# Referensi API & Fungsi (PHP & JavaScript)

## 1. Modul Autentikasi (`src/auth.php`)

### `cariAdmin(PDO $pdo, string $username): ?array`
- **Deskripsi:** Mencari data admin berdasarkan username[cite: 5, 6].
- **Parameter:** `$pdo` (PDO koneksi DB), `$username` (string username)[cite: 6].
- **Return:** `array` data admin atau `null` jika tidak ditemukan[cite: 6].

### `prosesLogin(PDO $pdo, string $username, string $sandi): bool`
- **Deskripsi:** Memeriksa kredensial admin, memverifikasi hash password, dan meregenerasi ID sesi[cite: 6].
- **Parameter:** `$pdo` (PDO koneksi DB), `$username` (string), `$sandi` (string)[cite: 6].
- **Return:** `true` jika berhasil login, `false` jika gagal[cite: 6].

### `wajibLogin(): void`
- **Deskripsi:** Memastikan halaman hanya diakses oleh admin yang terautentikasi (mengarahkan ke `login.php` jika belum login)[cite: 5, 6].

---

## 2. Modul Validasi (`src/validasi.php`)

### `validNoHp(string $noHp): bool`
- **Deskripsi:** Memeriksa apakah nomor HP diawali `08` dan memiliki panjang 10–13 digit.
- **Return:** `true` bila valid, `false` bila invalid.

### `hitungSisaKuota(int $kuota, int $terisi): int`
- **Deskripsi:** Menghitung sisa kuota kelas agar tidak bernilai negatif (`max(0, $kuota - $terisi)`)[cite: 6].

### `formatNomorBukti(int $tahun, int $id): string`
- **Deskripsi:** Membentuk format nomor bukti pendaftaran unik (`REG-YYYY-XXXXXX`).
- **Return:** `string` kode bukti pendaftaran.

---

## 3. JavaScript Assets (`public/assets/js/app.js`)

### `tampilkanFlash(flash: HTMLElement): void`
- **Deskripsi:** Menampilkan notifikasi toast SweetAlert2 berbasis atribut `data-pesan`[cite: 11].

### `pasangKonfirmasiHapus(): void`
- **Deskripsi:** Memasang dialog konfirmasi SweetAlert2 sebelum memicu proses hapus data[cite: 11].