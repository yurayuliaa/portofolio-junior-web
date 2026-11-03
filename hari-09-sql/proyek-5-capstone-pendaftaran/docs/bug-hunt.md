# Laporan Analisis Bug Hunt (Lab 6)

| No | Kode / Gejala Error | Penyebab Utama | Solusi Perbaikan |
|---|---|---|---|
| 1 | `SQLSTATE[HY000] [1045] Access denied for user` | Kredensial (username/password) database di `config.php` salah. | Periksa dan sesuaikan `user` dan `pass` dengan konfigurasi XAMPP MySQL. |
| 2 | `SQLSTATE[HY000] [1049] Unknown database` | Nama database di `config.php` tidak ditemukan di MySQL. | Pastikan nama database sesuai (`db_pelatihan`) dan skema SQL sudah diimpor. |
| 3 | `SQLSTATE[23000]: Integrity constraint violation: 1062` | Memasukkan nilai yang sama ke kolom bertipe `UNIQUE` (seperti email). | Tambahkan validasi cek email duplikat di `src/pendaftar.php` sebelum `INSERT`. |
| 4 | `PDOStatement::bindValue(): PDO::PARAM_INT required` | Mengikat variabel limit/offset paginasi sebagai string. | Gunakan penegasan tipe data `(int)` dan opsi `PDO::PARAM_INT` pada `bindValue()`. |
| 5 | `SQLSTATE[42000]: Syntax error... near WHERE` | Menjalankan query `DELETE` atau `UPDATE` tanpa klausa `WHERE`. | Selalu sertakan `WHERE id = :id` agar tidak menghapus/mengubah seluruh isi tabel. |
| 6 | SQL Injection via URL Query String | Menyambung variabel `$_GET['id']` langsung ke string query SQL. | Gunakan *prepared statement* `$pdo->prepare()` dan pengikatan parameter. |
| 7 | `SQLSTATE[42S22]: Column not found` | Lupa melakukan `JOIN` tabel `kelas` saat mengambil data pendaftar. | Gunakan query `JOIN kelas k ON k.id = p.kelas_id` pada query `SELECT`. |