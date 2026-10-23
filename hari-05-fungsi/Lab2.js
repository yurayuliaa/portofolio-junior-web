/**
 * Lab 2 - Array dan Method Array
 * Jalankan: node peserta.js
 */
const BATAS_LULUS = 70;

const peserta = [
  { id: 1, nama: 'Sari',  kelas: 'Web',  nilai: 90 },
  { id: 2, nama: 'Budi',  kelas: 'Web',  nilai: 68 },
  { id: 3, nama: 'Citra', kelas: 'Data', nilai: 82 },
  { id: 4, nama: 'Dewi',  kelas: 'Data', nilai: 75 },
  { id: 5, nama: 'Eka',   kelas: 'Web',  nilai: 55 },
  { id: 6, nama: 'Fajar', kelas: 'Jaringan', nilai: 88 },
  { id: 7, nama: 'Gita',  kelas: 'Jaringan', nilai: 64 },
  { id: 8, nama: 'Hadi',  kelas: 'Data', nilai: 91 },
  { id: 9, nama: 'Indra', kelas: 'Web',  nilai: 79 }
];

/**
 * Mengambil nama peserta yang lulus (filter lalu map).
 * @param {{nama: string, nilai: number}[]} daftar - Daftar peserta.
 * @param {number} [batas=BATAS_LULUS] - Nilai minimal lulus.
 * @returns {string[]} Nama peserta yang lulus.
 */
function namaLulus(daftar, batas = BATAS_LULUS) {
  return daftar.filter((p) => p.nilai >= batas).map((p) => p.nama);
}

/**
 * Menghitung rata-rata nilai per kelas.
 * @param {{kelas: string, nilai: number}[]} daftar - Daftar peserta.
 * @returns {Object<string, number>} Objek { kelas: rataRata }.
 */
function rataPerKelas(daftar) {
  const total = {};
  for (const p of daftar) {
    total[p.kelas] ??= { jumlah: 0, banyak: 0 };
    total[p.kelas].jumlah += p.nilai;
    total[p.kelas].banyak += 1;
  }
  const hasil = {};
  for (const kelas in total) {
    hasil[kelas] = total[kelas].jumlah / total[kelas].banyak;
  }
  return hasil;
}

/**
 * Mencari peserta dengan nilai tertinggi (reduce).
 * @param {{nilai: number}[]} daftar - Daftar peserta.
 * @returns {object|null} Peserta terbaik, atau null bila daftar kosong.
 */
function pesertaTertinggi(daftar) {
  if (daftar.length === 0) return null;
  return daftar.reduce((terbaik, p) => (p.nilai > terbaik.nilai ? p : terbaik));
}

/**
 * Mencari peserta berdasarkan sebagian nama (tidak peka huruf besar-kecil).
 * @param {{nama: string}[]} daftar - Daftar peserta.
 * @param {string} kataKunci - Potongan nama yang dicari.
 * @returns {object[]} Peserta yang namanya mengandung kata kunci.
 */
function cariNama(daftar, kataKunci) {
  const kunci = kataKunci.trim().toLowerCase();
  return daftar.filter((p) => p.nama.toLowerCase().includes(kunci));
}

/**
 * Membuat daftar peringkat tanpa mengubah array asli.
 * @param {{nama: string, nilai: number}[]} daftar - Daftar peserta.
 * @returns {{peringkat: number, nama: string, nilai: number}[]} Daftar terurut.
 */
function daftarPeringkat(daftar) {
  return [...daftar]
    .sort((a, b) => b.nilai - a.nilai)
    .map((p, i) => ({ peringkat: i + 1, nama: p.nama, nilai: p.nilai }));
}

/**
 * Menghapus email duplikat (huruf kecil, spasi dibuang) memakai Set.
 * @param {string[]} daftarEmail - Daftar email.
 * @returns {string[]} Email unik.
 */
function hapusDuplikat(daftarEmail) {
  return [...new Set(daftarEmail.map((e) => e.trim().toLowerCase()))];
}

// ---------- Demo ----------
console.log('Lulus      :', namaLulus(peserta));
console.log('Per kelas  :', rataPerKelas(peserta));
console.log('Tertinggi  :', pesertaTertinggi(peserta));
console.log('Cari "ar"  :', cariNama(peserta, 'AR').map((p) => p.nama));
console.table(daftarPeringkat(peserta));
console.log('Email unik :', hapusDuplikat(['a@x.com', 'A@x.com ', 'b@x.com']));

// ---------- Pengujian ----------
console.assert(namaLulus(peserta).length === 6, 'harus 6 peserta lulus');
console.assert(rataPerKelas(peserta).Jaringan === 76, 'rata Jaringan harus 76');
console.assert(pesertaTertinggi(peserta).nama === 'Hadi', 'tertinggi harus Hadi');
console.assert(pesertaTertinggi([]) === null, 'array kosong harus null');
console.assert(cariNama(peserta, 'sAr').length === 1, 'pencarian tidak peka huruf');
console.assert(daftarPeringkat(peserta)[0].peringkat === 1, 'peringkat mulai 1');
console.assert(peserta[0].nama === 'Sari', 'array asli tidak boleh berubah');
console.assert(hapusDuplikat(['a@x.com', 'A@x.com']).length === 1, 'duplikat dihapus');