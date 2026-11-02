const readline = require("readline/promises");

async function main() {
    const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout,
    });

    const nilai1 = parseFloat(await rl.question("Masukkan nilai pertama: "));
    const nilai2 = parseFloat(await rl.question("Masukkan nilai kedua: "));
    const pilih = (await rl.question("Pilih operasi (+, -, *, /): ")).trim();
    rl.close();

    let hasil;

    if (isNaN(nilai1) || isNaN(nilai2)) {
        hasil = "Input harus berupa angka";
    } else {
        switch (pilih) {
            case "+":
                hasil = nilai1 + nilai2;
                break;
            case "-":
                hasil = nilai1 - nilai2;
                break;
            case "*":
                hasil = nilai1 * nilai2;
                break;
            case "/":
                hasil = nilai2 === 0 ? "tidak terdefinisi" : nilai1 / nilai2;
                break;
            default:
                hasil = "Pilihan tidak valid";
        }
    }

    console.log("Hasil:", hasil);
}

main();
