const readline = require("readline/promises");
const { stdin: input, stdout: output } = require("process");

const NILAI_MIN = 0;
const NILAI_MAKS = 100;
const BATAS_LULUS = 70;

async function main() {
  const rl = readline.createInterface({ input, output });
  const daftarNama = [];
  const daftarNilai = [];
  let jalan = true;

  while (jalan) {
    console.log("\n===== PENGOLAH NILAI =====");
    console.log("1. Input nilai siswa");
    console.log("2. Tampilkan statistik");
    console.log("3. Tampilkan predikat per siswa");
    console.log("4. Keluar");
    const pilihan = await rl.question("Pilih menu (1-4): ");

    switch (pilihan) {
      case "1": {
        const nama = (await rl.question("Nama siswa: ")).trim();
        daftarNama.push(nama);
        const nilai = Number(await rl.question("Nilai (0-100): "));
        daftarNilai.push(nilai);
        // TODO: validasi nama tidak kosong dan nilai 0-100 (Number.isNaN)
        // TODO: jika valid, push ke daftarNama dan daftarNilai
        break;
      }
      case "2": {
        if (daftarNama.length === 0) {
          console.log("Tidak ada data siswa.");
        } else {
          let totalNilai = 0;
          for (let i = 0; i < daftarNilai.length; i++) {
            totalNilai += daftarNilai[i];
          }
          let rataRata = totalNilai / daftarNilai.length;
          let nilaiTertinggi = Math.max(...daftarNilai);
          let nilaiTerendah = Math.min(...daftarNilai);
          console.log(`Rata-rata: ${rataRata.toFixed(2)}`);
          console.log(`Nilai tertinggi: ${nilaiTertinggi}`);
          console.log(`Nilai terendah: ${nilaiTerendah}`);

          // TODO: hitung rata-rata, nilai tertinggi, dan nilai terendah dengan perulangan
        }
        break;
      }
      case "3": {
        // TODO: for dengan indeks; tampilkan nama, nilai, grade A/B/C/D, Lulus/Tidak lulus
        for (let i = 0; i < daftarNilai.length; i++) {
            console.log(`Nama: ${daftarNama[i]}, Nilai: ${daftarNilai[i]}`);
            if (daftarNilai[i] >= BATAS_LULUS) {
                console.log("Grade: Lulus");
            } else {
                console.log("Grade: Tidak Lulus");
            }
          }
        break;
      }
      case "4":
        jalan = false;
        console.log("Terima kasih.");
        break;
      default:
        console.log("Pilihan tidak valid.");
    }
  }
  rl.close();
}

main();