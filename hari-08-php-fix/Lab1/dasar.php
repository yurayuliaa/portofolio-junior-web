<?php

declare(strict_types=1);

require_once __DIR__ . '/../fungsi_pendukung/dev.php';
require_once __DIR__ . '/../fungsi_pendukung/lib-peserta.php';

const NAMA_HARI = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
const BATAS_PERKALIAN = 10;

/**
 * Hasil var_dump sebagai string, agar bisa ditampilkan di dalam <pre>.
 */
function dumpKeTeks(mixed $nilai): string
{
    ob_start();
    var_dump($nilai);

    return (string) ob_get_clean();
}

/**
 * Hasil FizzBuzz untuk satu angka.
 */
function fizzBuzz(int $angka): string
{
    return match (true) {
        $angka % 15 === 0 => 'FizzBuzz',
        $angka % 3 === 0 => 'Fizz',
        $angka % 5 === 0 => 'Buzz',
        default => (string) $angka,
    };
}

$nama = 'Sari';
$umur = 21;
$aktif = true;
$tinggi = 1.65;
$hariIni = NAMA_HARI[(int) date('w')];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 1 - PHP Dasar</title>
</head>
<body>
    <h1>Lab 1 - PHP Dasar</h1>

    <h2>1. Variabel</h2>
    <p>Nama: <?= e($nama) ?>, umur: <?= $umur ?> tahun, status: <?= $aktif ? 'aktif' : 'tidak aktif' ?>.</p>
    <pre><?= e(dumpKeTeks($nama) . dumpKeTeks($umur) . dumpKeTeks($tinggi) . dumpKeTeks($aktif)) ?></pre>
    <p>Tipe tinggi: <?= e(gettype($tinggi)) ?></p>

    <h2>2. Tabel perkalian 1-<?= BATAS_PERKALIAN ?></h2>
    <table border="1" cellpadding="4">
        <?php for ($baris = 1; $baris <= BATAS_PERKALIAN; $baris++): ?>
            <tr>
                <?php for ($kolom = 1; $kolom <= BATAS_PERKALIAN; $kolom++): ?>
                    <td><?= $baris * $kolom ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

    <h2>3. Ganjil/genap 1-20</h2>
    <ul>
        <?php for ($i = 1; $i <= 20; $i++): ?>
            <li><?= $i ?> = <?= $i % 2 === 0 ? 'genap' : 'ganjil' ?></li>
        <?php endfor; ?>
    </ul>

    <h2>4. FizzBuzz 1-30</h2>
    <p>
        <?php for ($i = 1; $i <= 30; $i++): ?>
            <?= e(fizzBuzz($i)) ?>
        <?php endfor; ?>
    </p>

    <h2>5. Nilai ke grade (match)</h2>
    <ul>
        <?php foreach ([92, 78, 64, 40] as $nilai): ?>
            <li>Nilai <?= $nilai ?> = grade <?= e(tentukanGrade($nilai)) ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>6. Kalender sederhana</h2>
    <p>Hari ini: <strong><?= e($hariIni) ?></strong>, <?= e(date('d-m-Y')) ?></p>
</body>
</html>