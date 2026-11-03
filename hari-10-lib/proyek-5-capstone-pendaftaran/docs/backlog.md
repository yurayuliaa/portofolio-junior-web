# Product Backlog & User Stories (Sprint 0 - Sprint 2)

---

## Tabel Backlog Terprioritas

| ID Story | Sebagai... | Saya ingin... | Agar... | Kriteria Penerimaan (Acceptance Criteria) | Prioritas | Target Sprint |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **US-01** | Peserta | Mengisi formulir pendaftaran pelatihan secara daring | Data saya tercatat sebagai calon peserta resmi | Form menerima nama, email, no HP, alamat, & kelas. Validasi mencegah input kosong. | Wajib (High) | Sprint 0 |
| **US-02** | Admin | Melihat daftar seluruh pendaftar beserta kelas yang dipilih | Dapat memantau perkembangan jumlah peserta pelatihan | Menampilkan tabel nama, email, no HP, & nama kelas menggunakan `JOIN`. | Wajib (High) | Sprint 0 |
| **US-03** | Admin | Melakukan pencarian data pendaftar berdasarkan nama/email | Dapat menemukan data peserta tertentu dengan cepat | Input pencarian memfilter hasil tabel secara langsung. | Wajib (High) | Sprint 0 |
| **US-04** | Admin | Melihat data pendaftar dalam bentuk paginasi | Tampilan tabel tetap rapi dan cepat diakses | Halaman membatasi 10 baris per halaman dengan navigasi nomor halaman. | Sedang (Medium) | Sprint 0 |
| **US-05** | Admin | Mengubah data pendaftar yang salah input | Informasi pendaftar selalu akurat | Form `ubah.php` terisi data lama dan dapat disimpan kembali ke DB. | Wajib (High) | Sprint 0 |
| **US-06** | Admin | Menghapus data pendaftar yang membatalkan pendaftaran | Data pendaftar yang tidak aktif terkonfirmasi terhapus | Tombol hapus menggunakan `POST` + Token CSRF dan konfirmasi dialog. | Wajib (High) | Sprint 0 |
| **US-07** | Peserta | Mendapatkan pesan error validasi yang jelas saat salah isi form | Tahu bagian form mana yang harus diperbaiki | Pesan error tampil di bawah masing-masing input field yang bermasalah. | Wajib (High) | Sprint 0 |
| **US-08** | Peserta | Mencetak bukti pendaftaran dalam format PDF | Memiliki dokumen fisik/digital resmi pendaftaran | Tersedia tombol cetak PDF yang menghasilkan file slip pendaftaran. | Wajib (High) | Sprint 1 |
| **US-09** | Admin | Memasuki halaman manajemen menggunakan autentikasi akun | Data pendaftaran aman dari akses publik tak berwenang | Sistem menyediakan form login admin dengan `password_hash` & session. | Wajib (High) | Sprint 2 |
| **US-10** | Sistem | Mencegah pendaftaran jika kuota kelas sudah penuh | Kapasitas kelas tidak melebihi batas maksimal | Pilihan kelas otomatis *disabled* atau ditolak jika kuota = 0. | Sedang (Medium) | Sprint 2 |