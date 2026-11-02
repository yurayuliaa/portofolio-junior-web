<?php

declare(strict_types=1);

require_once __DIR__ . '/dev.php';
require_once __DIR__ . '/lib-peserta.php';
require_once __DIR__ . '/lib-file.php';

$pesanGalat = null;
$baris = [];
try {
    $baris = bacaLogTerakhir();
} catch (RuntimeException $e) {
    error_log($e->getMessage());
    $pesanGalat = 'Log tidak dapat dibaca.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log Pengunjung</title>
</head>
<body>
    <h1>Log Pengunjung (<?= MAKS_BARIS_LOG ?> terakhir)</h1>
    <?php if ($pesanGalat !== null): ?>
        <p role="alert"><?= e($pesanGalat) ?></p>
    <?php elseif ($baris === []): ?>
        <p>Belum ada log. Buka <a href="cari.php">cari.php</a> dulu.</p>
    <?php else: ?>
        <ol>
            <?php foreach ($baris as $isi): ?>
                <li><?= e($isi) ?></li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
</body>
</html>