//deklarasi variabel
 
let nama = "AAA";
let umur = 20;
let tinggiBadan = 1.7;
let statusAktif = true;
console.log(nama, umur, tinggiBadan, statusAktif);
console.log(`Halo, ${nama}! Umur ${umur} tahun.`);
console.log(`Tinggi badan: ${tinggiBadan} m, Status aktif: ${statusAktif}`);

//cek tipe data

console.log('5' + 3); 
console.log(0.1 + 0.2);
console.log(Number('abc'));
console.log(10 / 3);
console.log(10 % 3);
console.log(2 ** 5); 

console.log(typeof('5' + 3)); 
console.log(typeof(0.1 + 0.2));
console.log(typeof(Number('abc')));
console.log(typeof(10 / 3));
console.log(typeof(10 % 3));
console.log(typeof(2 ** 10)); 

//Program menghitung luas dan keliling lingkaran

let jari = 10;
let luasLingkaran = Math.PI * jari ** 2;
console.log(`Luas lingkaran dengan jari-jari ${jari} adalah ${luasLingkaran}`);
let KelilingLingkaran = 2 * Math.PI * jari;
console.log(`Keliling lingkaran dengan jari-jari ${jari} adalah ${KelilingLingkaran}`);
//Program konversi suhu dari Celcius ke Fahrenheit
let suhuC = 100;
let suhuF = (suhuC * 9/5) + 32;
console.log(`${suhuC} derajat Celcius = ${suhuF} derajat Fahrenheit`);
//Program menghitung detik dalam satu hari
let detikPerHari = 24 * 60 * 60;
console.log(`Jumlah detik dalam satu hari adalah ${detikPerHari} detik`);
