// Editor Undo/Redo - Fitur A (dua Stack)
// Tantangan: riwayat maksimal 50 langkah + snapshot per jeda mengetik (debounce 500 ms)
import { Stack } from './structures.js';

const MAKS_RIWAYAT = 50;
const JEDA_MS = 500;

const editor = document.getElementById('editor');
const tombolUndo = document.getElementById('undo');
const tombolRedo = document.getElementById('redo');
const info = document.getElementById('info');

const undoStack = new Stack(MAKS_RIWAYAT);
const redoStack = new Stack(MAKS_RIWAYAT);
let teksSekarang = '';
let timer = null;

function perbaruiTombol() {
  tombolUndo.disabled = undoStack.isEmpty();
  tombolRedo.disabled = redoStack.isEmpty();
  info.textContent = `Riwayat: ${undoStack.size()} undo, ${redoStack.size()} redo`;
}

/** Menyimpan teks yang sedang ditampilkan sebagai satu langkah riwayat. */
function simpanSnapshot() {
  clearTimeout(timer);
  timer = null;
  if (editor.value === teksSekarang) return;
  undoStack.push(teksSekarang);
  teksSekarang = editor.value;
  redoStack.clear(); // pengetikan baru membuat riwayat redo tidak berlaku lagi
  perbaruiTombol();
}

editor.addEventListener('input', () => {
  clearTimeout(timer);
  timer = setTimeout(simpanSnapshot, JEDA_MS);
});

tombolUndo.addEventListener('click', () => {
  simpanSnapshot(); // masukkan ketikan yang belum tersimpan lebih dulu
  if (undoStack.isEmpty()) return;
  redoStack.push(teksSekarang);
  teksSekarang = undoStack.pop();
  editor.value = teksSekarang;
  perbaruiTombol();
});

tombolRedo.addEventListener('click', () => {
  simpanSnapshot();
  if (redoStack.isEmpty()) return;
  undoStack.push(teksSekarang);
  teksSekarang = redoStack.pop();
  editor.value = teksSekarang;
  perbaruiTombol();
});

perbaruiTombol();