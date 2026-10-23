import { hitungRataRata, cariTertinggi, cariTerendah } from './matematika.js';

const form = document.getElementById('form-nilai');
const kolom = document.getElementById('nilai');
const pesan = document.getElementById('pesan');
const elRata = document.getElementById('rata');
const elTinggi = document.getElementById('tinggi');
const elRendah = document.getElementById('rendah');

/**
 * Mengubah teks "80, 90, 75" menjadi array angka.
 * @param {string} teks - Angka dipisahkan koma.
 * @returns {number[]} Array angka (NaN bila ada bagian yang bukan angka).
 */
function ambilAngka(teks) {
  return teks.split(',').map((s) => s.trim()).filter((s) => s !== '').map(Number);
}

form.addEventListener('submit', (event) => {
  event.preventDefault();
  const angka = ambilAngka(kolom.value);

  if (angka.length === 0 || angka.some((n) => !Number.isFinite(n))) {
    pesan.textContent = 'Masukkan angka dipisahkan koma, contoh: 80, 90, 75';
    elRata.textContent = elTinggi.textContent = elRendah.textContent = '-';
    return;
  }
  pesan.textContent = '';
  elRata.textContent = hitungRataRata(angka).toFixed(2);
  elTinggi.textContent = cariTertinggi(angka);
  elRendah.textContent = cariTerendah(angka);
});