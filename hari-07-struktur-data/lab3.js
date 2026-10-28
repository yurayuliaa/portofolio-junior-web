// Lab 3 - Pencarian dan Pengurutan
import { pathToFileURL } from 'node:url';

/** Pencarian linear O(n). @returns {number} indeks, atau -1. */
export function cariLinear(daftar, target) {
  for (let i = 0; i < daftar.length; i++) {
    if (daftar[i] === target) return i;
  }
  return -1;
}

/** Pencarian biner O(log n); daftar WAJIB terurut. @returns {number} indeks, atau -1. */
export function cariBiner(daftarUrut, target) {
  let kiri = 0;
  let kanan = daftarUrut.length - 1;
  while (kiri <= kanan) {
    const tengah = Math.floor((kiri + kanan) / 2);
    if (daftarUrut[tengah] === target) return tengah;
    if (daftarUrut[tengah] < target) kiri = tengah + 1;
    else kanan = tengah - 1;
  }
  return -1;
}

/** Bubble sort O(n^2); `penghitung.perbandingan` bertambah tiap perbandingan. */
export function bubbleSort(daftar, penghitung = { perbandingan: 0 }) {
  const hasil = [...daftar];
  for (let i = 0; i < hasil.length - 1; i++) {
    let adaTukar = false;
    for (let j = 0; j < hasil.length - 1 - i; j++) {
      penghitung.perbandingan++;
      if (hasil[j] > hasil[j + 1]) {
        [hasil[j], hasil[j + 1]] = [hasil[j + 1], hasil[j]];
        adaTukar = true;
      }
    }
    if (!adaTukar) break;
  }
  return hasil;
}

/** Insertion sort O(n^2), O(n) bila hampir terurut. */
export function insertionSort(daftar, penghitung = { perbandingan: 0 }) {
  const hasil = [...daftar];
  for (let i = 1; i < hasil.length; i++) {
    const kunci = hasil[i];
    let j = i - 1;
    while (j >= 0) {
      penghitung.perbandingan++;
      if (hasil[j] <= kunci) break;
      hasil[j + 1] = hasil[j];
      j--;
    }
    hasil[j + 1] = kunci;
  }
  return hasil;
}

function gabung(kiri, kanan) {
  const hasil = [];
  let i = 0;
  let j = 0;
  while (i < kiri.length && j < kanan.length) {
    hasil.push(kiri[i] <= kanan[j] ? kiri[i++] : kanan[j++]);
  }
  return hasil.concat(kiri.slice(i), kanan.slice(j));
}

/** Merge sort O(n log n). */
export function mergeSort(daftar) {
  if (daftar.length <= 1) return daftar;
  const tengah = Math.floor(daftar.length / 2);
  return gabung(
    mergeSort(daftar.slice(0, tengah)),
    mergeSort(daftar.slice(tengah)),
  );
}

const acak = (n) =>
  Array.from({ length: n }, () => Math.floor(Math.random() * n * 10));
const terurut = (n) => Array.from({ length: n }, (_, i) => i);
const terbalik = (n) => terurut(n).reverse();
const urutNaik = (daftar) => [...daftar].sort((a, b) => a - b);

function ujiKorektness() {
  const kasus = {
    kosong: [],
    'satu elemen': [7],
    terurut: [1, 2, 3, 4, 5],
    terbalik: [5, 4, 3, 2, 1],
    duplikat: [3, 1, 3, 2, 1, 3],
  };
  const hasil = [];
  for (const [nama, data] of Object.entries(kasus)) {
    const benar = JSON.stringify(urutNaik(data));
    hasil.push({
      Kasus: nama,
      bubbleSort: JSON.stringify(bubbleSort(data)) === benar,
      insertionSort: JSON.stringify(insertionSort(data)) === benar,
      mergeSort: JSON.stringify(mergeSort(data)) === benar,
    });
  }
  console.table(hasil);
  console.log(
    'cariLinear([4,8,15], 15) =',
    cariLinear([4, 8, 15], 15),
    '| cariLinear([], 1) =',
    cariLinear([], 1),
  );
  console.log(
    'cariBiner([1,3,5,7,9], 7) =',
    cariBiner([1, 3, 5, 7, 9], 7),
    '| tidak ada (4) =',
    cariBiner([1, 3, 5, 7, 9], 4),
  );
  console.log(
    'cariBiner([], 1) =',
    cariBiner([], 1),
    '| cariBiner([5], 5) =',
    cariBiner([5], 5),
  );
}

function bandingkanPerbandingan() {
  const n = 1000;
  const hasil = [];
  for (const [nama, buat] of [
    ['acak', acak],
    ['terurut', terurut],
    ['terbalik', terbalik],
  ]) {
    const data = buat(n);
    const bubble = { perbandingan: 0 };
    const insertion = { perbandingan: 0 };
    bubbleSort(data, bubble);
    insertionSort(data, insertion);
    hasil.push({
      'Data (1000)': nama,
      bubbleSort: bubble.perbandingan,
      insertionSort: insertion.perbandingan,
    });
  }
  console.table(hasil);
}

function ukurWaktu(fungsi, data) {
  const mulai = performance.now();
  fungsi(data);
  return +(performance.now() - mulai).toFixed(2);
}

function bandingkanWaktu() {
  const hasil = [];
  for (const n of [10000, 100000]) {
    const data = acak(n);
    hasil.push({
      n,
      'bubbleSort (ms)': ukurWaktu(bubbleSort, data),
      'mergeSort (ms)': ukurWaktu(mergeSort, data),
      'Array.sort (ms)': ukurWaktu((d) => [...d].sort((a, b) => a - b), data),
    });
  }
  console.table(hasil);
}

if (import.meta.url === pathToFileURL(process.argv[1]).href) {
  console.log('--- 1. Uji kebenaran ---');
  ujiKorektness();
  console.log('--- 2. Jumlah perbandingan (n = 1000) ---');
  bandingkanPerbandingan();
  console.log('--- 3. Waktu (ms), bubbleSort 100.000 butuh beberapa detik ---');
  bandingkanWaktu();
}