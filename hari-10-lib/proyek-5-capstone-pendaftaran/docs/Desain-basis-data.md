# Dokumentasi Desain Basis Data (ERD)

---

## 1. Diagram Konseptual Relasi (ASCII ERD)

```text
+-------------------+             +-----------------------+
|       KELAS       |             |       PENDAFTAR       |
+-------------------+             +-----------------------+
| PK  id            |<----+       | PK  id                |
|     nama_kelas    |     |       |     nama              |
|     kuota         |     |       |     email (UNIQUE)    |
+-------------------+     |       |     no_hp             |
                          |       |     alamat            |
                          +-------| FK  kelas_id          |
                            (1-N) |     tgl_daftar        |
                                  +-----------------------+

+-------------------+
|       ADMIN       |
+-------------------+
| PK  id            |
|     username      |
|     password_hash |
|     dibuat_pada   |
+-------------------+
```

---

## 2. Spesifikasi Tabel

### A. Tabel `kelas`
- **Fungsi:** Menyimpan daftar master kelas pelatihan dan kapasitas kuota.
- **Engine:** InnoDB, Charset `utf8mb4`.

| Kolom | Tipe Data | Aturan / Constraint | Keterangan |
| :--- | :--- | :--- | :--- |
| `id` | `INT` | AUTO_INCREMENT, PRIMARY KEY | Identifier unik kelas |
| `nama_kelas` | `VARCHAR(100)` | NOT NULL | Nama modul/kelas pelatihan |
| `kuota` | `INT` | NOT NULL, DEFAULT 30 | Jumlah kuota maksimal peserta |

---

### B. Tabel `pendaftar`
- **Fungsi:** Menyimpan data diri peserta yang mendaftar pelatihan.
- **Engine:** InnoDB, Charset `utf8mb4`.

| Kolom | Tipe Data | Aturan / Constraint | Keterangan |
| :--- | :--- | :--- | :--- |
| `id` | `INT` | AUTO_INCREMENT, PRIMARY KEY | Identifier unik pendaftar |
| `nama` | `VARCHAR(100)` | NOT NULL | Nama lengkap peserta |
| `email` | `VARCHAR(120)` | NOT NULL, UNIQUE | Email aktif peserta (mencegah duplikat) |
| `no_hp` | `VARCHAR(20)` | NOT NULL | Nomor telepon/WhatsApp |
| `alamat` | `TEXT` | NULL | Alamat tempat tinggal |
| `kelas_id` | `INT` | NOT NULL, FOREIGN KEY | Merujuk ke `kelas(id)` |
| `tgl_daftar` | `TIMESTAMP` | DEFAULT CURRENT_TIMESTAMP | Waktu otomatis mendaftar |

* **Relasi Foreign Key:** `fk_pendaftar_kelas` (`kelas_id` $\rightarrow$ `kelas.id`) ON DELETE RESTRICT ON UPDATE CASCADE.
* **Indeks:** `idx_pendaftar_nama` pada kolom `nama` untuk mempercepat query `LIKE`.

---

### C. Tabel `admin`
- **Fungsi:** Menyimpan kredensial autentikasi pengelola aplikasi (Sprint 2).
- **Engine:** InnoDB, Charset `utf8mb4`.

| Kolom | Tipe Data | Aturan / Constraint | Keterangan |
| :--- | :--- | :--- | :--- |
| `id` | `INT` | AUTO_INCREMENT, PRIMARY KEY | Identifier unik admin |
| `username` | `VARCHAR(50)` | NOT NULL, UNIQUE | Username akun login |
| `password_hash` | `VARCHAR(255)` | NOT NULL | Hash kata sandi (`password_hash`) |
| `dibuat_pada` | `TIMESTAMP` | DEFAULT CURRENT_TIMESTAMP | Tanggal pembuatan akun |