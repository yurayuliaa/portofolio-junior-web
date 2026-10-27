// Antrean Loket - Fitur B (Queue) + reset harian, riwayat 5 terakhir, tombol Reset
import { Queue } from './structures.js';

const KUNCI = 'antrean-loket';
const MAKS_RIWAYAT = 5;

const antrian = new Queue();
let nomorTerakhir = 0;
let tanggal = hariIni();
let sedangDipanggil = '-';
let riwayat = []; // paling baru di depan

const elDipanggil = document.getElementById('dipanggil');
const elJumlah = document.getElementById('jumlah');
const elDaftar = document.getElementById('daftar');
const elRiwayat = document.getElementById('riwayat');

function hariIni() {
  const d = new Date();
  return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;
}

function formatNomor(angka) {
  return 'A' + String(angka).padStart(3, '0');
}

function simpan() {
  try {
    localStorage.setItem(KUNCI, JSON.stringify({
      tanggal, nomorTerakhir, sedangDipanggil, riwayat, menunggu: antrian.toArray(),
    }));
  } catch { /* penyimpanan tidak tersedia: aplikasi tetap jalan */ }
}

function resetSemua() {
  antrian.clear();
  nomorTerakhir = 0;
  sedangDipanggil = '-';
  riwayat = [];
  tanggal = hariIni();
}

function muat() {
  try {
    const data = JSON.parse(localStorage.getItem(KUNCI));
    if (data && data.tanggal === hariIni()) {
      ({ tanggal, nomorTerakhir, sedangDipanggil, riwayat } = data);
      data.menunggu.forEach((n) => antrian.enqueue(n));
    }
    // data hari sebelumnya diabaikan -> otomatis reset harian
  } catch { /* data rusak: mulai baru */ }
}

/** Dipanggil sebelum setiap aksi: bila tanggal berganti, nomor kembali ke A001. */
function cekGantiHari() {
  if (tanggal !== hariIni()) resetSemua();
}

function tampilkan() {
  elDipanggil.textContent = sedangDipanggil;
  elDaftar.textContent = '';
  for (const nomor of antrian.toArray()) {
    const li = document.createElement('li');
    li.textContent = nomor;
    elDaftar.append(li);
  }
  elJumlah.textContent = antrian.size();
  elRiwayat.textContent = riwayat.length ? riwayat.join(', ') : 'Belum ada.';
  simpan();
}

document.getElementById('ambil').addEventListener('click', () => {
  cekGantiHari();
  nomorTerakhir++;
  antrian.enqueue(formatNomor(nomorTerakhir));
  tampilkan();
});

document.getElementById('panggil').addEventListener('click', () => {
  cekGantiHari();
  if (antrian.isEmpty()) {
    sedangDipanggil = 'Antrean kosong';
  } else {
    sedangDipanggil = antrian.dequeue();
    riwayat.unshift(sedangDipanggil);
    riwayat = riwayat.slice(0, MAKS_RIWAYAT);
  }
  tampilkan();
});

document.getElementById('reset').addEventListener('click', () => {
  resetSemua();
  tampilkan();
});

muat();
tampilkan();