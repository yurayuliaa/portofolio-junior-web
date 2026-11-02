<?php

declare(strict_types=1);

require_once __DIR__ . '/dev.php';
require_once __DIR__ . '/lib-peserta.php';
require_once __DIR__ . '/lib-file.php';

/**
 * Menyaring peserta yang namanya memuat kata (tanpa peka huruf besar-kecil).
 *
 * @param array<int, array{nama: string}> $peserta
 * @return array<int, array{nama: string}>
 */
function cariPeserta(array $peserta, string $kata): array
{
    if ($kata === '') {
        return $peserta;
    }

    return array_values(array_filter(
        $peserta,
        fn (array $p): bool => mb_stripos($p['nama'], $kata, 0, 'UTF-8') !== false
    ));
}

$kata = trim((string) ($_GET['q'] ?? ''));
$pesanGalat = null;
try {
    catatLog($kata);
} catch (RuntimeException $e) {
    error_log($e->getMessage());
    $pesanGalat = 'Log pengunjung tidak dapat disimpan.';
}
$hasil = cariPeserta(ambilDataPeserta(), $kata);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 4 - Pencarian (GET)</title>
</head>
<body>
    <h1>Cari Peserta</h1>
    <form method="get" action="cari.php">
        <label for="q">Nama</label>
        <input id="q" name="q" value="<?= e($kata) ?>">
        <button type="submit">Cari</button>
    </form>
    <?php if ($pesanGalat !== null): ?>
        <p role="alert"><?= e($pesanGalat) ?></p>
    <?php endif; ?>
    <?php if ($hasil === []): ?>
        <p>Tidak ada peserta yang cocok dengan &quot;<?= e($kata) ?>&quot;.</p>
    <?php else: ?>
        <?= buatTabelPeserta($hasil) ?>
    <?php endif; ?>
    <p><a href="lihat-log.php">Lihat log</a></p>
</body>
</html>