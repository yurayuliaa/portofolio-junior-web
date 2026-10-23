const readline = require('readline/promises');
const { stdin: input, stdout: output } = require('process');
 
const NILAI_MIN = 0;
const NILAI_MAKS = 100;
const BATAS_LULUS = 70;
 
/**
 * Menghitung rata-rata dari sebuah daftar nilai.
 * @param {number[]} daftar - Array nilai.
 * @returns {number} Rata-rata nilai, atau 0 jika daftar kosong.
 */
function hitungRataRata(daftar) {
  if (daftar.length === 0) return 0;
  return daftar.reduce((jumlah, n) => jumlah + n, 0) / daftar.length;
}
 
/**
 * Mencari nilai tertinggi dalam daftar.
 * @param {number[]} daftar - Array nilai.
 * @returns {number|null} Nilai tertinggi, atau null jika daftar kosong.
 */
function cariTertinggi(daftar) {
  return daftar.length === 0 ? null : Math.max(...daftar);
}
 
/**
 * Mencari nilai terendah dalam daftar.
 * @param {number[]} daftar - Array nilai.
 * @returns {number|null} Nilai terendah, atau null jika daftar kosong.
 */
function cariTerendah(daftar) {
  return daftar.length === 0 ? null : Math.min(...daftar);
}
 
/**
 * Menentukan grade berdasarkan nilai.
 * @param {number} nilai - Nilai siswa (0-100).
 * @returns {string} Grade 'A', 'B', 'C', atau 'D'.
 */
function tentukanGrade(nilai) {
  if (nilai >= 85) return 'A';
  if (nilai >= 70) return 'B';
  if (nilai >= 55) return 'C';
  return 'D';
}
 
/**
 * Menentukan status kelulusan berdasarkan nilai.
 * @param {number} nilai - Nilai siswa (0-100).
 * @returns {string} 'Lulus' jika nilai >= BATAS_LULUS, selain itu 'Tidak lulus'.
 */
function tentukanStatus(nilai) {
  return nilai >= BATAS_LULUS ? 'Lulus' : 'Tidak lulus';
}
 
/**
 * Memeriksa apakah nilai valid (angka terhingga dalam rentang 0-100).
 * @param {number} nilai - Nilai yang diperiksa.
 * @returns {boolean} true jika valid, false jika tidak.
 */
function nilaiValid(nilai) {
  return Number.isFinite(nilai) && nilai >= NILAI_MIN && nilai <= NILAI_MAKS;
}
 
/**
 * Prosedur: menampilkan daftar menu ke layar.
 * @returns {void}
 */
function tampilkanMenu() {
  console.log('\n===== PENGOLAH NILAI =====');
  console.log('1. Input nilai siswa');
  console.log('2. Tampilkan statistik');
  console.log('3. Tampilkan predikat per siswa');
  console.log('4. Keluar');
}
 
/**
 * Prosedur: menampilkan laporan satu siswa (nama, nilai, grade, status).
 * @param {string} nama - Nama siswa.
 * @param {number} nilai - Nilai siswa.
 * @returns {void}
 */
function tampilkanLaporan(nama, nilai) {
  const grade = tentukanGrade(nilai);
  const status = tentukanStatus(nilai);
  console.log(
    `Nama: ${nama.padEnd(12)} | Nilai: ${String(nilai).padStart(3)} | Grade: ${grade} | Status: ${status}`
  );
}
 
/**
 * Fungsi utama: menjalankan menu interaktif Pengolah Nilai.
 * @returns {Promise<void>}
 */
async function main() {
  const rl = readline.createInterface({ input, output });
  const daftarNama = [];
  const daftarNilai = [];
  let jalan = true;
 
  while (jalan) {
    tampilkanMenu();
    const pilihan = (await rl.question('Pilih menu (1-4): ')).trim();
 
    switch (pilihan) {
      case '1': {
        const nama = (await rl.question('Nama siswa: ')).trim();
        const teksNilai = (await rl.question(`Nilai (${NILAI_MIN}-${NILAI_MAKS}): `)).trim();
        // Number('') bernilai 0, jadi input kosong harus dianggap tidak valid
        const nilai = teksNilai === '' ? NaN : Number(teksNilai);
 
        if (nama === '') {
          console.log('Nama tidak boleh kosong.');
        } else if (!nilaiValid(nilai)) {
          console.log(`Nilai harus berupa angka antara ${NILAI_MIN} dan ${NILAI_MAKS}.`);
        } else {
          daftarNama.push(nama);
          daftarNilai.push(nilai);
          console.log('Data berhasil disimpan.');
        }
        break;
      }
      case '2': {
        if (daftarNilai.length === 0) {
          console.log('\nBelum ada data nilai yang dimasukkan.');
        } else {
          console.log('\n===== STATISTIK NILAI =====');
          console.log(`Jumlah Siswa    : ${daftarNilai.length}`);
          console.log(`Rata-rata       : ${hitungRataRata(daftarNilai).toFixed(2)}`);
          console.log(`Nilai Tertinggi : ${cariTertinggi(daftarNilai)}`);
          console.log(`Nilai Terendah  : ${cariTerendah(daftarNilai)}`);
        }
        break;
      }
      case '3': {
        if (daftarNama.length === 0) {
          console.log('\nBelum ada data siswa.');
        } else {
          console.log('\n===== PREDIKAT PER SISWA =====');
          for (let i = 0; i < daftarNama.length; i++) {
            tampilkanLaporan(daftarNama[i], daftarNilai[i]);
          }
        }
        break;
      }
      case '4':
        jalan = false;
        console.log('Terima kasih.');
        break;
      default:
        console.log('Pilihan tidak valid.');
    }
  }
  rl.close();
}
 
// Pengujian sederhana (tidak mencetak apa pun bila benar)
console.assert(hitungRataRata([80, 90]) === 85, 'rata-rata 80,90 harus 85');
console.assert(hitungRataRata([]) === 0, 'rata-rata array kosong harus 0');
console.assert(tentukanGrade(85) === 'A', 'nilai 85 harus A');
console.assert(tentukanGrade(69) === 'C', 'nilai 69 harus C');
console.assert(nilaiValid(101) === false, '101 tidak valid');
 
main();