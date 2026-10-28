/**
 * app.js - Penghubung DOM: membaca/menulis elemen dan memanggil logika.
 */
import { SistemAntrean } from './antrian.js';
import { RiwayatEditor } from './riwayat.js';

const KUNCI_CATATAN = 'catatan-terakhir';
const JEDA_KETIK_MS = 500;
const PESAN_ANTREAN_KOSONG =
  'Antrean kosong. Tekan "Ambil Nomor" untuk menambah pasien.';

const ambil = (id) => document.getElementById(id);
const antrean = new SistemAntrean();
const editor = ambil('editor');
let timerKetik = null;

function bacaCatatanTersimpan() {
  try {
    return localStorage.getItem(KUNCI_CATATAN) ?? '';
  } catch {
    return ''; // penyimpanan diblokir: mulai dengan catatan kosong
  }
}

const riwayat = new RiwayatEditor(bacaCatatanTersimpan());

function simpanCatatan(teks) {
  try {
    localStorage.setItem(KUNCI_CATATAN, teks);
  } catch {
    ambil('pesan-editor').textContent =
      'Catatan tidak dapat disimpan di peramban ini.';
  }
}

function tampilkanAntrean() {
  ambil('jumlah').textContent = antrean.jumlahMenunggu();
  ambil('daftar').replaceChildren(
    ...antrean.daftarMenunggu().map((nomor) => {
      const item = document.createElement('li');
      item.textContent = nomor;
      return item;
    }),
  );
  const terakhir = antrean.riwayatPanggilan();
  ambil('riwayat-panggil').textContent = terakhir.length
    ? terakhir.join(', ')
    : 'Belum ada pemanggilan.';
}

function tampilkanEditor() {
  ambil('undo').disabled = !riwayat.bisaUndo();
  ambil('redo').disabled = !riwayat.bisaRedo();
  ambil('info-riwayat').textContent =
    `Riwayat: ${riwayat.jumlahUndo()} undo, ${riwayat.jumlahRedo()} redo`;
}

function ambilNomor() {
  const nomor = antrean.ambilNomor();
  ambil('pesan-antrean').textContent =
    `Nomor ${nomor} diambil. Menunggu: ${antrean.jumlahMenunggu()}.`;
  tampilkanAntrean();
}

function panggilNomor() {
  const nomor = antrean.panggil();
  if (nomor === null) {
    ambil('pesan-antrean').textContent = PESAN_ANTREAN_KOSONG;
  } else {
    ambil('dipanggil').textContent = nomor;
    ambil('pesan-antrean').textContent = `Memanggil ${nomor}.`;
  }
  tampilkanAntrean();
}

function resetAntrean() {
  const pesanKonfirmasi =
    'Reset akan menghapus semua antrean dan riwayat. Lanjutkan?';
  if (!confirm(pesanKonfirmasi)) return;
  antrean.reset();
  ambil('dipanggil').textContent = '-';
  ambil('pesan-antrean').textContent =
    'Antrean direset. Nomor berikutnya A001.';
  tampilkanAntrean();
}

function catatPerubahan() {
  clearTimeout(timerKetik);
  if (riwayat.catat(editor.value)) simpanCatatan(editor.value);
  tampilkanEditor();
}

function jalankanUndoRedo(aksi) {
  catatPerubahan(); // masukkan ketikan yang belum tersimpan lebih dulu
  const teks = aksi();
  if (teks !== null) {
    editor.value = teks;
    simpanCatatan(teks);
  }
  tampilkanEditor();
}

ambil('ambil').addEventListener('click', ambilNomor);
ambil('panggil').addEventListener('click', panggilNomor);
ambil('reset').addEventListener('click', resetAntrean);
ambil('undo').addEventListener('click', () =>
  jalankanUndoRedo(() => riwayat.undo()),
);
ambil('redo').addEventListener('click', () =>
  jalankanUndoRedo(() => riwayat.redo()),
);
editor.addEventListener('input', () => {
  clearTimeout(timerKetik);
  timerKetik = setTimeout(catatPerubahan, JEDA_KETIK_MS);
});

editor.value = riwayat.teks();
tampilkanAntrean();
tampilkanEditor();