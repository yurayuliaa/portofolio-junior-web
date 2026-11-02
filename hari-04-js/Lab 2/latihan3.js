// Tarif parkir: 2 jam pertama Rp3.000, tiap jam berikutnya Rp2.000, maksimum Rp15.000 per hari.

let durasi_jam = 27; // Ganti dengan input sesuai kebutuhan, misal: 27

// 1. Menghitung jumlah hari utuh dan sisa jam menggunakan pembagian bulat dan sisa bagi (modulus)
let total_hari = Math.floor(durasi_jam / 24);
let sisa_jam = durasi_jam % 24;

// 2. Menghitung tarif untuk sisa jam pada hari terakhir
let biaya_sisa_jam;
if (sisa_jam <= 2) {
    biaya_sisa_jam = 3000;
} else {
    biaya_sisa_jam = 3000 + ((sisa_jam - 2) * 2000);
}

// 3. Terapkan batas maksimum Rp15.000 per hari untuk sisa jam
if (biaya_sisa_jam > 15000) {
    biaya_sisa_jam = 15000;
}

// 4. Hitung total biaya keseluruhan (hari utuh x Rp15.000 + biaya sisa jam)
let total_biaya = (total_hari * 15000) + biaya_sisa_jam;

console.log(total_biaya);