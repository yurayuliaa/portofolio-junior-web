# Analisis Pemilihan Struktur Data (Templat T7)

## 1. Daftar kontak ponsel dengan pencarian nama
| Bagian | Isi |
|---|---|
| Masalah | Aplikasi kontak harus menemukan satu kontak dengan cepat berdasarkan nama. |
| Data | Objek kontak (nama, nomor, email); ratusan sampai ribuan entri. |
| Operasi dominan | Cari berdasar nama (sangat sering), tambah (jarang), hapus/ubah (jarang), tampilkan urut abjad (sering). |
| Alternatif | (a) Array of objek, (b) Map dengan kunci nama. |
| Perbandingan | **Array**: cari nama dengan `find` = O(n); urut abjad mudah dengan `sort`; sederhana. **Map**: `get(nama)` = O(1) rata-rata; tambah/hapus O(1); tapi tidak otomatis terurut abjad dan satu nama hanya bisa satu kontak. |
| Keputusan | **Map** (kunci = nama atau id) untuk pencarian cepat; saat menampilkan daftar, ubah menjadi array lalu `sort` dengan `localeCompare`. Bila ada nama kembar, kunci memakai id kontak dan pencarian nama memakai indeks tambahan. |

## 2. Riwayat halaman yang dikunjungi (tombol Back)
| Bagian | Isi |
|---|---|
| Masalah | Browser harus kembali ke halaman sebelumnya, dan maju lagi setelah Back. |
| Data | URL halaman; puluhan sampai ratusan entri per tab. |
| Operasi dominan | Kunjungi halaman baru (sering), Back (sering), Forward (kadang). Selalu yang **terakhir dikunjungi** diproses lebih dulu. |
| Alternatif | (a) Stack, (b) Queue, (c) Array dengan indeks posisi. |
| Perbandingan | **Stack**: `push` saat kunjungi, `pop` saat Back, semua O(1), cocok dengan pola LIFO. **Queue**: urutan FIFO salah, Back akan membuka halaman tertua. **Array + indeks**: fleksibel tetapi lebih rawan salah indeks. |
| Keputusan | **Dua Stack**: `backStack` dan `forwardStack`. Kunjungi halaman: `push` halaman sekarang ke `backStack`, kosongkan `forwardStack`. **Back**: `push` halaman sekarang ke `forwardStack`, lalu `pop` dari `backStack`. **Forward**: kebalikannya. Pola ini sama dengan Undo/Redo pada editor hari ini. |

## 3. Antrean pasien klinik dengan kasus darurat
| Bagian | Isi |
|---|---|
| Masalah | Pasien dilayani adil sesuai urutan datang, tetapi pasien gawat darurat harus didahulukan. |
| Data | Objek pasien (nama, nomor, tingkat prioritas, waktu datang); puluhan per hari. |
| Operasi dominan | Daftar pasien baru (sering), panggil pasien berikutnya (sering), lihat siapa berikutnya (sering). |
| Alternatif | (a) Queue biasa, (b) Priority Queue, (c) beberapa Queue (satu per tingkat prioritas). |
| Perbandingan | **Queue biasa**: `enqueue`/`dequeue` O(1), adil, tetapi pasien darurat yang datang belakangan tetap menunggu di belakang, berbahaya. **Priority Queue** (heap): pasien dengan prioritas tertinggi keluar dulu, `enqueue`/`dequeue` O(log n); bila prioritas sama, urutan datang (waktu) menjadi pembeda. **Banyak Queue**: sederhana, O(1), cukup bila prioritas hanya 2-3 level. |
| Keputusan | **Priority Queue**. Queue biasa tidak cukup karena aturan FIFO murni tidak mengenal tingkat kegawatan. Untuk klinik kecil dengan hanya level "darurat" dan "biasa", dua Queue (darurat dipanggil lebih dulu) juga memadai dan lebih mudah dibuat. |