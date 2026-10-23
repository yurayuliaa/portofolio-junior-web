import { hitung } from './operasi.js';

const MAKS_RIWAYAT = 5;
const MAKS_DIGIT = 15;

const layarEl = document.getElementById('layar');
const papan = document.getElementById('papan');
const riwayatEl = document.getElementById('riwayat');

let layar = '0';
let angkaPertama = null;
let operator = null;
let siapReset = false;
const riwayat = [];

/** Menampilkan nilai `layar` ke elemen layar. */
function perbaruiLayar() {
  layarEl.textContent = layar;
}

/** Menampilkan 5 perhitungan terakhir (textContent, aman dari XSS). */
function tampilkanRiwayat() {
  riwayatEl.replaceChildren(
    ...riwayat.map((teks) => {
      const li = document.createElement('li');
      li.textContent = teks;
      return li;
    })
  );
}

/**
 * Menyimpan satu perhitungan ke riwayat (maksimal 5, terbaru di atas).
 * @param {string} teks - Contoh: "2 + 3 = 5".
 */
function catatRiwayat(teks) {
  riwayat.unshift(teks);
  if (riwayat.length > MAKS_RIWAYAT) riwayat.pop();
  tampilkanRiwayat();
}

/**
 * Menambahkan digit atau titik desimal ke layar.
 * @param {string} digit - '0'-'9' atau '.'.
 */
function masukkanAngka(digit) {
  if (siapReset) {
    layar = digit === '.' ? '0.' : digit;
    siapReset = false;
    return;
  }
  if (digit === '.' && layar.includes('.')) return;
  if (layar.length >= MAKS_DIGIT) return;
  layar = layar === '0' && digit !== '.' ? digit : layar + digit;
}

/** Menghitung hasil; pesan galat (mis. bagi nol) ditampilkan di layar. */
function hitungHasil() {
  if (operator === null) return;
  const kiri = angkaPertama;
  const kanan = Number(layar);
  try {
    const hasil = Number(hitung(operator, kiri, kanan).toFixed(10));
    if (!Number.isFinite(hasil)) throw new Error('Hasil terlalu besar');
    catatRiwayat(`${kiri} ${operator} ${kanan} = ${hasil}`);
    layar = String(hasil);
  } catch (error) {
    layar = error.message;
  }
  operator = null;
  angkaPertama = null;
  siapReset = true;
}

/**
 * Memilih operator. Menekan operator dua kali hanya mengganti operator.
 * @param {string} op - '+', '-', '*', atau '/'.
 */
function pilihOperator(op) {
  if (operator !== null && !siapReset) hitungHasil();
  if (Number.isNaN(Number(layar))) return; // layar berisi pesan galat
  angkaPertama = Number(layar);
  operator = op;
  siapReset = true;
}

/** Menghapus satu karakter terakhir dari layar. */
function hapusSatu() {
  if (siapReset) return;
  layar = layar.length > 1 ? layar.slice(0, -1) : '0';
}

/** Mengembalikan kalkulator ke keadaan awal (tombol C). */
function bersihkan() {
  layar = '0';
  angkaPertama = null;
  operator = null;
  siapReset = false;
}

// Event delegation: satu pendengar untuk semua tombol
papan.addEventListener('click', (event) => {
  const tombol = event.target.closest('button');
  if (!tombol) return;

  if (tombol.dataset.angka !== undefined) masukkanAngka(tombol.dataset.angka);
  else if (tombol.dataset.operator) pilihOperator(tombol.dataset.operator);
  else if (tombol.dataset.aksi === 'sama') hitungHasil();
  else if (tombol.dataset.aksi === 'hapus') bersihkan();

  perbaruiLayar();
});

// Tantangan: dukungan keyboard
document.addEventListener('keydown', (event) => {
  const { key } = event;
  if (/^[0-9.]$/.test(key)) masukkanAngka(key);
  else if (['+', '-', '*', '/'].includes(key)) pilihOperator(key);
  else if (key === 'Enter' || key === '=') { event.preventDefault(); hitungHasil(); }
  else if (key === 'Backspace') hapusSatu();
  else if (key === 'Escape' || key.toLowerCase() === 'c') bersihkan();
  else return;
  perbaruiLayar();
});