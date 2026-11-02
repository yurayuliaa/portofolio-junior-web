// Penentu bilangan ganjil/genap dan positif/negatif/nol
let nilai = 12; // Ganti 5 dengan nilai yang ingin diuji
let status1 = "", status2 = "", status3 = "";

// Menentukan ganjil/genap
if (nilai % 2 == 0) {
	status1 = "genap";
} else {
	status1 = "ganjil";
}
console.log(status1);

// Menentukan positif/negatif/nol
if (nilai > 0) {
	status2 = "positif";
} else if (nilai < 0) {
	status2 = "negatif";
} else {
	status2 = "nol";
}
console.log(status2);
