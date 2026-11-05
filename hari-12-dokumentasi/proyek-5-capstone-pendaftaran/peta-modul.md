# Peta Modul Proyek

Dokumen ini memetakan seluruh berkas yang ada di dalam direktori `src/` dan `public/`, beserta tanggung jawab utama dan fungsi publik (ekspor) yang disediakan oleh masing-masing berkas.

## Direktori `public/`

Direktori ini berisi aset-aset statis yang tidak diproses oleh _bundler_ (seperti Webpack atau Vite) dan akan disajikan langsung ke peramban.

| Berkas | Tanggung Jawab | Daftar Fungsi/Ekspor Publik |
| :--- | :--- | :--- |
| `public/index.php` | Titik masuk (entry point) utama PHP untuk aplikasi. | N/A (Berkas statis) |
| `public/_form.php` | Menampilkan form untuk input dan edit data. | N/A (Berkas statis) |
| `public/cetak.php` | Untuk cetak tanda pendaftaran masing-masing peserta. | N/A (Berkas statis) |
| `public/hapus.php` | Untuk menghapus data peserta. | N/A (Berkas statis) |
| `public/login.php` | Halaman login untuk masuk ke aplikasi. | N/A (Berkas statis) |
| `public/logout.php` | Menangani proses keluar (logout) dari aplikasi. | N/A (Berkas statis) |
| `public/tambah.php` | Halaman form untuk menambah data pendaftar. | N/A (Berkas statis) |
| `public/ubah.php` | Halaman form untuk mengubah atau memperbarui data. | N/A (Berkas statis) |

## Direktori `src/`

Direktori ini berisi seluruh kode sumber utama aplikasi (logika, komponen, utilitas, dan gaya) yang akan dikompilasi sebelum dipublikasikan.

| Berkas | Tanggung Jawab | Daftar Fungsi/Ekspor Publik |
| :--- | :--- | :--- |
| `src/auth.php` | Berisi fungsi-fungsi untuk autentikasi pengguna. | N/A |
| `src/bootstrap.php` | Memastikan inisialisasi dan kelengkapan kebutuhan aplikasi. | N/A |
| `src/helpers.php` | Berisi fungsi untuk keamanan dan kebutuhan dasar aplikasi. | N/A |
| `src/pendaftar.php` | Berisi fungsi-fungsi untuk manajemen pendaftar. | N/A |

> **Catatan untuk Pengembang:** Silakan perbarui tabel di atas jika ada penambahan berkas baru, perubahan nama fungsi, atau refaktor kode untuk memastikan dokumentasi ini selalu relevan dengan _codebase_ terkini.