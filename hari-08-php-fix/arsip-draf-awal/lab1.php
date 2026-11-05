<?php

declare(strict_types=1);
//Cetak nama, umur, dan status memakai variabel;
echo '<h3>Perkenalan Diri</h3>';
$nama = 'Sari';
$umur = 25;
$status = 'Mahasiswa';
echo 'Halo, saya ' . $nama . ' umur ' . $umur . ' tahun dan status saya ' . $status . '.</br>';
echo "Halo, saya $nama umur $umur tahun dan status saya $status.</br>";
//tampilkan var_dump tiap variabel.
echo '<h3>Var Dump</h3>';
var_dump($nama, $umur, $status);
//Buat tabel perkalian 1 sampai 10 dalam <table> dengan for bersarang.
echo '<h3>Tabel Perkalian 1-10</h3>';
echo '<table border="1">';
for ($i = 1; $i <= 10; $i++) {
    echo '<tr>';
    for ($j = 1; $j <= 10; $j++) {
        echo '<td>' . ($i * $j) . '</td>';
    }
    echo '</tr>';
}
echo '</table>';
//bilangan ganjil/genap 1-20
echo '<h3>Bilangan Ganjil dan Genap 1-20</h3>';
echo '<p>Ganjil: ';
for ($i = 1; $i <= 20; $i += 2) {
    echo $i . ' ';
}
echo '</p>';
echo '<p>Genap: ';
for ($i = 2; $i <= 20; $i += 2) {
    echo $i . ' ';
}
echo '</p>';
//FizzBuzz 1-30
echo '<h3>FizzBuzz 1-30</h3>';
for ($i = 1; $i <= 30; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0) {
        echo 'FizzBuzz ';
    } elseif ($i % 3 === 0) {
        echo 'Fizz ';
    } elseif ($i % 5 === 0) {
        echo 'Buzz ';
    } else {
        echo $i . ' ';
    }
}
// konversi nilai ke grade dengan match.
echo '<h3>Konversi Nilai ke Grade</h3>';
$nilai = 85;
$grade = match (true) {
    $nilai >= 80 => 'A',
    $nilai >= 70 => 'B',
    $nilai >= 60 => 'C',
    default => 'D'
};
echo "<p>Nilai: $nilai</p>";
echo "<p>Grade: $grade</p>";
////Jalankan program kalender sederhana: tampilkan hari ini dengan nama hari berbahasa Indonesia memakai array ['Minggu', 'Senin', ...] dan date('w').
$hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$hariIni = date('w');
echo '<h3>Kalender Sederhana</h3>';
echo '<p>Hari dalam angka (aturan fungsi date php) ' . $hariIni . '</p>';
echo '<p>Hari ini adalah ' . $hari[$hariIni] . '</p>';
echo '<p> Waktu Server: ' . date('d-m-Y H:i:s') . '</p>';
echo "<p> Waktu Server: " . date('d-m-Y H:i:s') . "</p>";
?>
<p>Waktu server: <?= date('d-m-Y H:i:s') ?></p>