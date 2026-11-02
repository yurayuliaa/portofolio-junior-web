<?php

declare(strict_types=1);

$nama = 'Sari';
$umur = 25;
$status = 'Mahasiswa';

$nama = 'Sari';
echo 'Halo, saya ' . $nama .  'umur saya' . $umur . 'tahun, dan status saya' . $status . '.</br>'
//tampilkan var_dump tiap variabel
var_dump($nama, $umur, $status);
//buat tabel perkalian 1 sampai 10 dalam <tabel> dengan for bersarang
echo '<table border="1">';
for ($i = 1; $i <= 10; $i++) {
    echo '<tr>';
    for ($j =1; $j <= 10; $j++) (
        echo '<td>' . ($i * $j) . '</td>';
    )
    echo '</tr>';
}
echo '</table>';
//bilangan ganjil/genap 1-20
echo '<h3>Bilangan Ganjil dan Genap 1-20<?h3>';
echo '<p>Ganjil: ';
for ($i = 1; $i <= 20; $i += 2) {
    echo $i . '';
}
echo '</p>';
echo '<p>Genap: ';
for ($i = 1; $i <= 20; $i += 2) {
    echo $i . '';
}
echo '</p>';
?>

<p>Waktu server: <?= date('d-m-Y H:i') ?></p>
