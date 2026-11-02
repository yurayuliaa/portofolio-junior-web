//pengolah nilai
//1. Input nilai siswa 
//2. Tampilkan rata-rata, nilai tertinggi, dan terendah 
//3. Tampilkan predikat lulus/tidak lulus per siswa 
//4. Keluar 

const readline = require('readline/promises'); 
const { stdin: input, stdout: output } = require('process'); 
 
const NILAI_MIN = 0; 
const NILAI_MAKS = 100; 
const BATAS_LULUS = 70; 
 
async function main() { 
  const rl = readline.createInterface({ input, output }); 
  const daftarNama = []; 
  const daftarNilai = []; 
  let jalan = true; 
 
  while (jalan) { 
    console.log('\n===== PENGOLAH NILAI ====='); 
    console.log('1. Input nilai siswa'); 
    console.log('2. Tampilkan statistik'); 
    console.log('3. Tampilkan predikat per siswa'); 
    console.log('4. Keluar'); 
    const pilihan = await rl.question('Pilih menu (1-4): '); 
 
    switch (pilihan) { 
      case '1': { 
        const nama = (await rl.question('Nama siswa: ')).trim(); 
        const nilai = Number(await rl.question('Nilai (0-100): ')); 
        // TODO: validasi nama tidak kosong dan nilai 0-100 (Number.isNaN) 
        // TODO: jika valid, push ke daftarNama dan daftarNilai 
        if (nama === '') {
            console.log('Nama tidak boleh kosong yaw');
        } else if (Number.isNaN(nilai) || nilai < NILAI_MIN || nilai > NILAI_MAKS) {
            console.log(`Nilai harus berupa angka antara ${NILAI_MIN} dan ${NILAI_MAKS}`);
        } else {
            daftarNama.push(nama);
            daftarNilai.push(nilai);
        }
        break; 
      } 
      case '2': { 
        // TODO: jika kosong tampilkan pesan; jika ada hitung rata-rata, 
        // nilai tertinggi, dan nilai terendah dengan perulangan
        break; 
      } 
      case '3': { 
        // TODO: for dengan indeks; tampilkan nama, nilai, grade A/B/C/D, Lulus/Tidak lulus 
        if (daftarNama.length) {
            for (let i = 0; i < daftarNama.length; i++) {
                const nama = daftarNama[i];
                const nilai = daftarNilai[i];
            let grade;
                if (nilai >= 90) {
                    grade = 'A';
                } else if (nilai >= 80) {
                    grade = 'B';
                } else if (nilai >= 70) {
                    grade = 'C';
                } else {
                    grade = 'D';
                }
                // TODO: hitung grade dan status lulus
            let status = nilai >= BATAS_LULUS ? 'Pass' : 'Fail';
                console.log('Nama:', nama, '/ Nilai:', nilai, '/Grade:', grade, '/Status:', status);
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
 
main(); 
