1. Database & SQL
01-phpmyadmin-db.png: Tampilan phpMyAdmin saat membuka database db_pelatihan yang menampilkan 3 tabel (admin, kelas, pendaftar).

02-skema-sql.png: Tampilan kode file database/skema.sql di VS Code.

03-latihan-sql.png: Tampilan kode file database/latihan.sql (atau hasil query latihan di phpMyAdmin).

2. SQL Injection (Versi Berbahaya vs Aman)
04-injeksi-demo.png: Tampilan halaman http://localhost/.../public/injeksi.php?email=x' OR '1'='1 yang memperlihatkan perbedaan versi Berbahaya (7 baris) dan versi Aman (0 baris).

3. Modul CRUD Pendaftar & Validasi
05-crud-index.png: Halaman utama index.php yang menampilkan tabel data pendaftar dan tombol aksi.

06-crud-pencarian-paginasi.png: Hasil pencarian nama/email dan tombol paginasi di bawah tabel.

07-crud-tambah.png: Halaman tambah.php saat diisi data pendaftar baru.

08-validasi-error.png: Pesan error merah saat form dikirim kosong atau memasukkan email yang sudah terdaftar.

09-flash-sukses.png: Pesan flash hijau "Data pendaftar berhasil ditambahkan!" setelah berhasil menyimpan.

10-crud-ubah.php: Halaman ubah.php dengan data lama yang otomatis terisi di kolom form.

4. Dokumen Sprint 0 & Bug Hunt
11-docs-sprint0.png: Tampilan daftar berkas analisis-kebutuhan.md, backlog.md, erd.md, dan wireframe.md di folder docs/.

12-bug-hunt.png: Tampilan tabel analisis error pada file docs/bug-hunt.md.

Langkah 3: Buat Berkas docs/bukti-portofolio.md
Buat file baru docs/bukti-portofolio.md di VS Code, lalu salin dan tempel (paste) template laporan portofolio berikut:

# Laporan Bukti Portofolio - Hari 9 (Capstone Sprint 0)

Dokumen ini berisi rangkuman dan bukti tangkap layar (screenshot) hasil pengerjaan modul Hari 9: Basis Data SQL, Keamanan PDO, Modul CRUD Pendaftar, serta Dokumen Perancangan Sprint 0.

---

## 1. Basis Data & Berkas SQL

### 1.1 Skema Basis Data & phpMyAdmin
![Struktur Database phpMyAdmin](./screenshots/01-phpmyadmin-db.png)
* **Keterangan:** Basis data `db_pelatihan` berhasil dibangun dari nol dengan 3 tabel utama (`admin`, `kelas`, dan `pendaftar`) beserta relasi *Foreign Key* dan *Index*.

### 1.2 Berkas SQL (`skema.sql` & `latihan.sql`)
![File Skema SQL](./screenshots/02-skema-sql.png)
![File Latihan SQL](./screenshots/03-latihan-sql.png)
* **Keterangan:** Berkas DDL `skema.sql` berisi perintah pembuatan tabel dan relasi, sedangkan `latihan.sql` berisi kueri manipulasi data (DML, JOIN, GROUP BY, dan agregasi).

---

## 2. Demonstrasi Keamanan SQL Injection

![Demo SQL Injection](./screenshots/04-injeksi-demo.png)

### Penjelasan Penanganan Keamanan:
* **Versi Berbahaya (Hasil: 7 Baris):** Menggunakan penggabungan string (*string concatenation*). Masukan `x' OR '1'='1` mengubah logika query sehingga kondisi bernilai selalu `TRUE` dan memungut seluruh data dari database.
* **Versi Aman / PDO Prepared Statement (Hasil: 0 Baris):** Menggunakan `$pdo->prepare()` dan pengikatan parameter (`:email`). MySQL memperlakukan seluruh masukan `x' OR '1'='1` murni sebagai 1 string teks email mentah, sehingga serangan manipulasi query gagal.

---

## 3. Pengujian Modul CRUD & Validasi

### 3.1 Halaman Utama, Pencarian, & Paginasi
![Halaman Utama CRUD](./screenshots/05-crud-index.png)
![Pencarian dan Paginasi](./screenshots/06-crud-pencarian-paginasi.png)
* **Keterangan:** Menampilkan daftar pendaftar terpaginasi (5 data per halaman) dan fitur pencarian nama/email yang berfungsi responsif.

### 3.2 Form Tambah & Pesan Validasi Server
![Form Tambah Data](./screenshots/07-crud-tambah.png)
![Pesan Validasi Error](./screenshots/08-validasi-error.png)
![Pesan Flash Sukses](./screenshots/09-flash-sukses.png)
* **Keterangan:** Sistem memvalidasi input di tingkat server (format email, email duplikat, nomor HP). Jika validasi lolos, sistem menerapkan pola PRG (Post-Redirect-Get) dan menampilkan pesan flash sukses.

### 3.3 Form Ubah Data
![Form Ubah Data](./screenshots/10-crud-ubah.php)
* **Keterangan:** Membaca data lama berdasarkan parameter ID secara aman dan memperbarui record pendaftar.

---

## 4. Dokumen Deliverables Sprint 0 & Bug Hunt

### 4.1 Dokumen Perancangan Sprint 0
![Dokumen Sprint 0](./screenshots/11-docs-sprint0.png)
* **Keterangan:** Berkas perancangan awal yang tersimpan di folder `docs/`:
  1. `analisis-kebutuhan.md` (Pengguna, Fitur MVP, Batasan)
  2. `backlog.md` (10 User Stories & Prioritas)
  3. `erd.md` (Struktur Relasi Tabel & Kamus Data)
  4. `wireframe.md` (Rancangan Tampilan UI Halaman)

### 4.2 Tabel Analisis Bug Hunt (Lab 6)
![Tabel Bug Hunt](./screenshots/12-bug-hunt.png)
* **Keterangan:** Dokumentasi analisis 7 jenis eror umum pengembangan PHP/MySQL beserta akar masalah dan solusi perbaikannya pada file `docs/bug-hunt.md`.

Langkah 4: Commit & Push ke GitHub
Setelah file gambar dan markdown portofolio tersimpan, jalankan perintah ini di Terminal VS Code: