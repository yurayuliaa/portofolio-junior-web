---

### 2. `docs/bug-hunt-hari-10.md`

```markdown
# Tabel Analisis Bug Hunt - Hari 10 (Sprint 1)

| No | Gejala Error | Penyebab Utama | Solusi Perbaikan |
|---|---|---|---|
| 1 | `$ is not defined` / `DataTable is not a function` | Urutan pemanggilan script JS salah; DataTables dimuat sebelum jQuery | Pindahkan script jQuery (`jquery.min.js`) ke urutan paling atas di `templates/footer.php` |
| 2 | Navbar tidak bisa dibuka di tampilan layar ponsel | Script Bootstrap Bundle JS (`bootstrap.bundle.min.js`) belum dimuat | Tambahkan CDN Bootstrap Bundle JS sebelum `app.js` di `footer.php` |
| 3 | `Fatal error: Uncaught Error: Class 'Dompdf\Dompdf' not found` | Berkas `vendor/autoload.php` belum di-require atau belum `composer install` | Jalankan `composer require dompdf/dompdf` dan tambahkan `require_once __DIR__ . '/../vendor/autoload.php';` |
| 4 | Berkas PDF yang dicetak kosong atau mengalami kerusakan (*corrupt*) | Terdapat output karakter (spasi, HTML, atau `echo`) sebelum perintah `$dompdf->stream()` | Hapus spasi sebelum `<?php` dan gunakan penampung output `ob_start()` serta `ob_get_clean()` |
| 5 | DataTables menampilkan peringatan (*warning*) jumlah kolom | Jumlah tag `<th>` pada `<thead>` tidak sama dengan jumlah `<td>` pada `<tbody>` | Samakan jumlah kolom tabel header dan body (misal: 6 kolom `<th>` dan 6 `<td>`) |
| 6 | Dialog konfirmasi hapus SweetAlert2 tidak muncul, data langsung terhapus | Tag form hapus tidak memiliki class `form-hapus` atau jalur `app.js` salah | Tambahkan class `class="form-hapus"` pada tag `<form>` dan pastikan path `assets/js/app.js` benar |
| 7 | Tampilan antarmuka berubah acak/rusak setelah beberapa waktu | Menggunakan versi `@latest` pada tautan CDN pustaka | Kunci versi pustaka secara spesifik pada CDN (contoh: `bootstrap@5.3.3`) |