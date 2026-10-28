# Proyek 3 - Simulator Antrean dan Riwayat

Simulator untuk klinik kecil: layar antrean pasien (Fitur A) dan editor catatan dengan undo/redo (Fitur B).

## Cara menjalankan

Aplikasi memakai ES module, jadi harus dibuka lewat server lokal (bukan klik dua kali pada `index.html`).

1. Buka folder `proyek-3-antrian` di VS Code.
2. Pilih salah satu:
   - Klik kanan `index.html`, lalu **Open with Live Server** (ekstensi Live Server), atau
   - Di terminal: `npx serve .`, lalu buka alamat yang tampil (mis. `http://localhost:3000`).
3. Uji logika tanpa browser: `node uji.js`.
4. Cek kualitas kode (butuh `npm install` sekali): `npm run lint` dan `npm run format:cek`.

## Struktur

```
proyek-3-antrian/
  index.html
  css/style.css
  js/structures.js   Stack, LinkedList, LinkedQueue (murni, tanpa DOM, private field, JSDoc)
  js/antrian.js      logika antrean (SistemAntrean)
  js/riwayat.js      logika undo/redo (RiwayatEditor)
  js/app.js          penghubung DOM
  uji.js             kasus uji minimal
```

## Tangkapan layar

Letakkan di folder `tangkapan-layar/` lalu sesuaikan nama berkas:

- `![Antrean](tangkapan-layar/antrean.png)`
- `![Editor](tangkapan-layar/editor.png)`

## Alasan pemilihan struktur data

| Kebutuhan | Struktur dipilih | Alasan | Alternatif dan mengapa tidak dipilih |
|---|---|---|---|
| Antrean pasien | `LinkedQueue` | `enqueue` dan `dequeue` O(1); pasien dilayani sesuai urutan datang (FIFO) | Array + `shift` (O(n) per `dequeue`, lambat untuk antrean besar) |
| Riwayat undo/redo | `Stack` (dua buah) | Perubahan terakhir dibatalkan lebih dulu (LIFO); `push`/`pop` O(1); batas 50 langkah | Queue (urutan salah: yang tertua dibatalkan lebih dulu) |
| Riwayat 5 panggilan terakhir | Array dibatasi panjang | Ukuran kecil (maksimal 5) dan ditampilkan berurutan | Linked list (berlebihan untuk 5 elemen) |

## Fitur dan penanganan error

- Nomor berurutan `A001`, `A002`, ... (`AWALAN_NOMOR`, `PANJANG_NOMOR`).
- Panggil saat antrean kosong menampilkan pesan: "Antrean kosong. Tekan Ambil Nomor untuk menambah pasien."
- Reset meminta konfirmasi dan menomori ulang dari A001.
- Undo/Redo nonaktif saat kosong; riwayat maksimal `MAKS_RIWAYAT = 50`; snapshot disimpan tiap jeda mengetik 500 ms (debounce).
- Mengetik setelah undo menghapus riwayat redo.
- Catatan terakhir disimpan di `localStorage`; bila penyimpanan diblokir, muncul pesan dan aplikasi tetap jalan.
- Input bukan string ke `RiwayatEditor` melempar `TypeError`; `Stack` dengan `maxSize` tidak valid melempar `RangeError`.

## Kasus uji minimal (`node uji.js`)

Ambil 3 nomor lalu panggil 4 kali (ke-4 kosong), undo 3 kali lalu redo 2 kali, ketik setelah undo (redo terhapus), reset saat antrean berisi. Semuanya lulus (8 kelompok uji).