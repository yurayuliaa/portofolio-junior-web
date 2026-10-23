import {
  validasiNama, validasiEmail, validasiHp, validasiSandi, validasiKonfirmasi
} from './aturan.js';

const form = document.getElementById('form-daftar');
const tombolKirim = document.getElementById('kirim');
const ringkasan = document.getElementById('ringkasan');

const aturan = {
  nama: (nilai) => validasiNama(nilai),
  email: (nilai) => validasiEmail(nilai),
  hp: (nilai) => validasiHp(nilai),
  sandi: (nilai) => validasiSandi(nilai),
  konfirmasi: (nilai) => validasiKonfirmasi(nilai, form.elements.sandi.value)
};

/**
 * Menampilkan pesan galat di bawah kolom dan menandai aria-invalid.
 * @param {string} nama - Nama kolom (name).
 * @param {string} pesan - Pesan galat; '' berarti valid.
 */
function tampilkanGalat(nama, pesan) {
  document.getElementById(`galat-${nama}`).textContent = pesan;
  form.elements[nama].setAttribute('aria-invalid', pesan ? 'true' : 'false');
}

/**
 * Memeriksa satu kolom lalu menampilkan hasilnya.
 * @param {string} nama - Nama kolom.
 * @returns {boolean} true bila valid.
 */
function periksaField(nama) {
  const pesan = aturan[nama](form.elements[nama].value);
  tampilkanGalat(nama, pesan);
  return pesan === '';
}

/** @returns {boolean} true bila semua kolom valid (tanpa menampilkan pesan). */
function semuaValid() {
  return Object.keys(aturan).every((nama) => aturan[nama](form.elements[nama].value) === '');
}

form.addEventListener('input', (event) => {
  const nama = event.target.name;
  if (nama in aturan) periksaField(nama);
  if (nama === 'sandi' && form.elements.konfirmasi.value !== '') periksaField('konfirmasi');
  tombolKirim.disabled = !semuaValid();
});

form.addEventListener('submit', (event) => {
  event.preventDefault();
  const hasil = Object.keys(aturan).map(periksaField);
  if (!hasil.every(Boolean)) return;

  // Ringkasan tanpa sandi, memakai textContent
  ringkasan.hidden = false;
  ringkasan.textContent =
    `Pendaftaran berhasil: ${form.elements.nama.value.trim()} ` +
    `(${form.elements.email.value}, ${form.elements.hp.value})`;
  form.reset();
  tombolKirim.disabled = true;
});
