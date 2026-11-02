<?php

declare(strict_types=1);

require_once __DIR__ . '/dev.php';
require_once __DIR__ . '/lib-peserta.php';
require_once __DIR__ . '/lib-file.php';

const FILE_JSON = FOLDER_DATA . '/peserta.json';
const FILE_CSV = FOLDER_DATA . '/peserta.csv';
const FILE_TIDAK_ADA = FOLDER_DATA . '/tidak-ada.json';
const FILE_RUSAK = FOLDER_DATA . '/rusak.json';

/**
 * Menjalankan aksi file dan mengubah kegagalan menjadi pesan ramah.
 * Detail teknis hanya dicatat di log server.
 *
 * @param callable(): array<mixed> $aksi
 * @return array{data: array<mixed>, galat: string|null}
 */
function jalankanAman(callable $aksi): array
{
    try {
        return ['data' => $aksi(), 'galat' => null];
    } catch (RuntimeException $e) {
        error_log($e->getMessage());

        return ['data' => [], 'galat' => $e->getMessage()];
    }
}

// 1-3. JSON: simpan, baca kembali, tambah satu peserta, simpan ulang
$jsonAwal = jalankanAman(function (): array {
    tulisJson(FILE_JSON, ambilDataPeserta());

    return bacaJson(FILE_JSON);
});
$jsonAkhir = jalankanAman(function () use ($jsonAwal): array {
    $daftar = $jsonAwal['data'];
    $daftar[] = ['nama' => 'Fajar', 'kelas' => 'Web', 'nilai' => 88];
    tulisJson(FILE_JSON, $daftar);

    return bacaJson(FILE_JSON);
});

// 4. CSV: ekspor lalu impor kembali
$csv = jalankanAman(function () use ($jsonAkhir): array {
    tulisCsv(FILE_CSV, $jsonAkhir['data'], ['nama', 'kelas', 'nilai']);

    return bacaCsv(FILE_CSV);
});

// 5. Kegagalan: berkas tidak ada dan JSON rusak
file_put_contents(FILE_RUSAK, '{bukan json');
$tidakAda = jalankanAman(fn (): array => bacaJson(FILE_TIDAK_ADA));
$rusak = jalankanAman(fn (): array => bacaJson(FILE_RUSAK));
unlink(FILE_RUSAK);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 4 - JSON dan CSV</title>
</head>
<body>
    <h1>Lab 4 - JSON dan CSV</h1>

    <h2>JSON: setelah ditambah satu peserta (<?= count($jsonAkhir['data']) ?> data)</h2>
    <?= buatTabelPeserta($jsonAkhir['data']) ?>

    <h2>CSV: hasil impor kembali</h2>
    <table border="1" cellpadding="6">
        <?php foreach ($csv['data'] as $baris): ?>
            <tr>
                <?php foreach ($baris as $sel): ?>
                    <td><?= e((string) $sel) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Penanganan kegagalan</h2>
    <ul>
        <li>Berkas tidak ada: <?= e((string) $tidakAda['galat']) ?></li>
        <li>JSON rusak: <?= e((string) $rusak['galat']) ?></li>
    </ul>
</body>
</html>