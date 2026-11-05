<?php

declare(strict_types=1);

require_once __DIR__ . '/functions.php';

const PESAN_SISTEM = 'Terjadi kesalahan pada sistem. Silakan coba lagi nanti.';

$galat = [];
$lama = ['nama' => '', 'email' => '', 'pesan' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hasil = validasiTamu($_POST);
    $lama = $hasil['data'];
    $galat = $hasil['galat'];

    if ($galat === []) {
        try {
            if (simpanTamu($hasil['data'])) {
                header('Location: index.php?status=sukses');
                exit;
            }
            $galat['umum'] = 'Gagal menyimpan data. Silakan coba lagi.';
        } catch (RuntimeException $e) {
            error_log($e->getMessage());
            $galat['umum'] = PESAN_SISTEM;
        }
    }
}

$kata = trim((string) ($_GET['q'] ?? ''));
$daftarTamu = [];
try {
    $daftarTamu = array_reverse(cariTamu(ambilSemuaTamu(), $kata));
} catch (RuntimeException $e) {
    error_log($e->getMessage());
    $galat['umum'] ??= PESAN_SISTEM;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku Tamu</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 40rem; margin: 1rem auto; padding: 0 1rem; }
        input, textarea { width: 100%; box-sizing: border-box; font: inherit; padding: .4rem; }
        .galat { color: #a8281f; }
        article { border-top: 1px solid #ccc; margin-top: 1rem; }
    </style>
</head>
<body>
    <h1>Buku Tamu</h1>

    <?php if (($_GET['status'] ?? '') === 'sukses'): ?>
        <p role="status">Terima kasih, pesan Anda sudah tersimpan.</p>
    <?php endif; ?>
    <?php if (isset($galat['umum'])): ?>
        <p role="alert" class="galat"><?= e($galat['umum']) ?></p>
    <?php endif; ?>

    <form method="post" action="index.php">
        <p>
            <label for="nama">Nama</label><br>
            <input id="nama" name="nama" value="<?= e($lama['nama']) ?>">
            <?php if (isset($galat['nama'])): ?>
                <span class="galat"><?= e($galat['nama']) ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="email">Email</label><br>
            <input id="email" name="email" type="email" value="<?= e($lama['email']) ?>">
            <?php if (isset($galat['email'])): ?>
                <span class="galat"><?= e($galat['email']) ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="pesan">Pesan</label><br>
            <textarea id="pesan" name="pesan" rows="4"><?= e($lama['pesan']) ?></textarea>
            <?php if (isset($galat['pesan'])): ?>
                <span class="galat"><?= e($galat['pesan']) ?></span>
            <?php endif; ?>
        </p>
        <button type="submit">Kirim</button>
    </form>

    <h2>Daftar Tamu</h2>
    <form method="get" action="index.php">
        <label for="q">Cari nama</label>
        <input id="q" name="q" value="<?= e($kata) ?>">
        <button type="submit">Cari</button>
    </form>

    <?php if ($daftarTamu === []): ?>
        <p>Belum ada data.</p>
    <?php else: ?>
        <?php foreach ($daftarTamu as $tamu): ?>
            <article>
                <h3><?= e((string) $tamu['nama']) ?></h3>
                <p><small><?= e((string) $tamu['waktu']) ?></small></p>
                <p><?= nl2br(e((string) $tamu['pesan'])) ?></p>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>