# Catatan Pengujian Pembaruan Library (Lab 6)

## 1. Hasil Pemeriksaan Library
* **`composer outdated`**: Memeriksa pustaka Composer yang memiliki versi lebih baru.
* **`composer audit`**: Memeriksa kerentanan keamanan (*security vulnerabilities*) pada pustaka yang terpasang.

## 2. Penjelasan Semantic Versioning (^2.1.0 vs ~2.1.0)
* Aturan caret (`^`) pada `composer.json` mengizinkan pembaruan otomatis hingga sebelum versi *MAJOR* berikutnya (misal `^2.1.0` boleh naik ke `2.9.0`, tetapi tidak boleh melompat ke `3.0.0`).
* Aturan tilde (`~`) hanya mengizinkan pembaruan otomatis hingga sebelum versi *MINOR* berikutnya (misal `~2.1.0` boleh naik ke `2.1.9`, tetapi tidak boleh melompat ke `2.2.0`).
* **Wanted**: Versi tertinggi yang diizinkan oleh aturan batasan semver pada file konfigurasi.
* **Latest**: Versi paling baru yang tersedia di repositori pustaka (Packagist).

## 3. Simulasi Pembaruan & Pembatalan (Rollback)
Saat menguji pembaruan pustaka pada *branch* eksperimen (`uji-update`):
1. Jika hasil pembaruan pustaka menimbulkan eror atau masalah kompatibilitas, pembaruan dibatalkan dengan perintah:
   ```bash
   git restore composer.json composer.lock
   composer install