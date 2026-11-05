<?php

declare(strict_types=1);

require_once __DIR__ . '/../fungsi_pendukung/dev.php';
require_once __DIR__ . '/../fungsi_pendukung/lib-peserta.php';

$peserta = ambilDataPeserta();
$tertinggi = cariTertinggi($peserta);
$kelompok = kelompokkanPerKelas($peserta);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 2 - Fungsi dan Array Asosiatif</title>
</head>
<body>
    <h1>Lab 2 - Fungsi dan Array Asosiatif</h1>

    <h2>Semua peserta</h2>
    <?= buatTabelPeserta($peserta) ?>
    <p>Rata-rata: <?= number_format(hitungRataRata($peserta), 1) ?></p>
    <p>
        Tertinggi:
        <?= $tertinggi === null ? '-' : e($tertinggi['nama']) . ' (' . $tertinggi['nilai'] . ')' ?>
    </p>

    <h2>Lulus (nilai &ge; <?= BATAS_LULUS ?>)</h2>
    <?= buatTabelPeserta(filterLulus($peserta)) ?>

    <h2>Diurutkan dari nilai tertinggi</h2>
    <?= buatTabelPeserta(urutkanNilai($peserta)) ?>

    <h2>Dikelompokkan per kelas</h2>
    <?php foreach ($kelompok as $namaKelas => $anggota): ?>
        <h3>Kelas <?= e((string) $namaKelas) ?> (<?= count($anggota) ?> peserta)</h3>
        <?= buatTabelPeserta($anggota) ?>
    <?php endforeach; ?>

    <h2>Kasus tepi: daftar kosong</h2>
    <p>
        Rata-rata kosong: <?= hitungRataRata([]) ?>;
        tertinggi kosong: <?= var_export(cariTertinggi([]), true) ?>
    </p>
</body>
</html>