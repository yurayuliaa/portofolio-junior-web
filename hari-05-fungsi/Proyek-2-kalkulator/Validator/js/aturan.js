/**
 * Memvalidasi nama (minimal 3 karakter setelah spasi dibuang).
 * @param {string} nilai - Isi kolom nama.
 * @returns {string} Pesan galat, atau '' bila valid.
 */
export function validasiNama(nilai) {
  return nilai.trim().length >= 3 ? '' : 'Nama minimal 3 karakter.';
}

/**
 * Memvalidasi format email.
 * @param {string} nilai - Isi kolom email.
 * @returns {string} Pesan galat, atau '' bila valid.
 */
export function validasiEmail(nilai) {
  const pola = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return pola.test(nilai) ? '' : 'Format email tidak valid.';
}

/**
 * Memvalidasi nomor HP Indonesia (08 + 8-11 digit).
 * @param {string} nilai - Isi kolom nomor HP.
 * @returns {string} Pesan galat, atau '' bila valid.
 */
export function validasiHp(nilai) {
  return /^08[0-9]{8,11}$/.test(nilai) ? '' : 'Nomor HP diawali 08 dan 10-13 digit.';
}

/**
 * Memvalidasi kekuatan kata sandi (>= 8 karakter, ada huruf dan angka).
 * @param {string} nilai - Isi kolom sandi.
 * @returns {string} Pesan galat, atau '' bila valid.
 */
export function validasiSandi(nilai) {
  const kuat = nilai.length >= 8 && /[0-9]/.test(nilai) && /[A-Za-z]/.test(nilai);
  return kuat ? '' : 'Sandi minimal 8 karakter, kombinasi huruf dan angka.';
}

/**
 * Memastikan konfirmasi sama dengan sandi.
 * @param {string} nilai - Isi kolom konfirmasi.
 * @param {string} sandi - Isi kolom sandi.
 * @returns {string} Pesan galat, atau '' bila cocok.
 */
export function validasiKonfirmasi(nilai, sandi) {
  return nilai === sandi ? '' : 'Konfirmasi sandi tidak cocok.';
}
