//tabel perkalian 1-10
for (let i = 1; i <= 10; i++) {
    for (let j = 1; j <= 10; j++) {
        console.log(`${i} x ${j} = ${i * j}`);
    }
}

//segitiga bintang
for (let i = 1; i <= 10; i++) {
    let hasil = '';
    for (let j = 1; j <= i; j++) {
        hasil += '*';
    }
    console.log(hasil);
}

//fizzbuzz 1-50
for(let i = 1; i <= 50; i++) {
    if (i % 3 === 0 && i % 5 === 0) {
        console.log('FizzBuzz');
    } else if (i % 3 === 0) {
        console.log('Fizz');
    } else if (i % 5 === 0) {
        console.log('Buzz');
    } else {
        console.log(i);
    }
}

//nembak angka random
let angka = Math.floor(Math.random() * 100) + 1; //jalankan di console browser
let input;
do {
    input =  parseInt(prompt("Masukkan angka : " ));
    if (input < angka) {
        console.log("Angka terlalu kecil");
    } else if (input > angka) {
        console.log("Angka terlalu besar");
    } else {
        console.log("Selamat! Anda menebak angka yang benar:", angka);
    }
} while (angka !== input);