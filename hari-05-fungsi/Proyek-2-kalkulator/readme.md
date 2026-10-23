# Proyek 2 - Kalkulator dan Form Validator

Dua aplikasi web statis (HTML, CSS, JavaScript ES Module) untuk Hari 5.

## Struktur
```
proyek-2-kalkulator/
  kalkulator/  index.html, css/style.css, js/operasi.js, js/app.js
  validator/   index.html, css/style.css, js/aturan.js,  js/app.js
  README.md
```
Logika (`operasi.js`, `aturan.js`) dipisah dari UI (`app.js`).

## Cara menjalankan
Modul ES tidak berjalan lewat `file:///`. Buka folder di VS Code, klik kanan
`index.html` > **Open with Live Server** (atau taruh di `htdocs` XAMPP).

## Fitur
- **Kalkulator:** angka 0-9, titik desimal, + - x /, C, =, layar di atas, CSS Grid.
  Tantangan: keyboard (angka, operator, Enter, Backspace, Esc), riwayat 5 perhitungan.
- **Validator:** validasi saat mengetik dan saat kirim, pesan di bawah kolom
  (`aria-live`, `aria-invalid`, tanda ⚠ selain warna), tombol Kirim nonaktif sampai valid,
  ringkasan tanpa sandi memakai `textContent`.

## Kasus tepi yang diuji
| Kasus | Hasil yang diharapkan |
|-------|-----------------------|
| `0.1 + 0.2` | tampil `0.3` |
| `5 / 0` | pesan "Tidak bisa dibagi nol", `C` memulihkan |
| Operator ditekan dua kali (`5 + - 3`) | operator terakhir dipakai |
| Operator setelah pesan galat | diabaikan |
| Mulai dengan `.` | tampil `0.` |
| Dua titik pada satu angka | titik kedua diabaikan |
| Angka sangat panjang | dibatasi 15 digit; hasil besar bisa digulir |
| Nama hanya spasi | "Nama minimal 3 karakter." |
| Email tanpa `@` / HP tidak diawali 08 | pesan galat |
| Sandi hanya huruf / hanya angka | pesan galat |
| Konfirmasi berbeda; sandi diubah setelah konfirmasi | konfirmasi diperiksa ulang |

## Tangkapan layar
(Tempel `kalkulator.png` dan `validator.png` di sini.)

## Git
```
git add .
git commit -m "Hari 5: Proyek 2 kalkulator dan form validator"
git push
```
