/** Menjumlahkan dua angka. @param {number} a @param {number} b @returns {number} */
export const tambah = (a, b) => a + b;

/** Mengurangkan b dari a. @param {number} a @param {number} b @returns {number} */
export const kurang = (a, b) => a - b;

/** Mengalikan dua angka. @param {number} a @param {number} b @returns {number} */
export const kali = (a, b) => a * b;

/**
 * Membagi a dengan b.
 * @param {number} a - Angka yang dibagi.
 * @param {number} b - Pembagi.
 * @returns {number} Hasil bagi.
 * @throws {Error} Bila b bernilai 0.
 */
export function bagi(a, b) {
  if (b === 0) throw new Error('Tidak bisa dibagi nol');
  return a / b;
}

/**
 * Menjalankan operasi sesuai operator.
 * @param {'+'|'-'|'*'|'/'} operator - Simbol operator.
 * @param {number} a - Angka pertama.
 * @param {number} b - Angka kedua.
 * @returns {number} Hasil perhitungan.
 * @throws {Error} Bila operator tidak dikenal atau pembagian dengan nol.
 */
export function hitung(operator, a, b) {
  switch (operator) {
    case '+': return tambah(a, b);
    case '-': return kurang(a, b);
    case '*': return kali(a, b);
    case '/': return bagi(a, b);
    default: throw new Error('Operator tidak dikenal');
  }
}