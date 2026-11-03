<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$pdo = getConnection();
$email = $_GET['email'] ?? '';

// BERBAHAYA: input pengguna digabung langsung ke string SQL
$sqlBahaya = "SELECT id, nama, email FROM pendaftar WHERE email = '" . $email . "'";
$hasilBahaya = $pdo->query($sqlBahaya)->fetchAll();

// AMAN: Menggunakan Prepared Statement PDO
$stmt = $pdo->prepare('SELECT id, nama, email FROM pendaftar WHERE email = :email');
$stmt->execute(['email' => $email]);
$hasilAman = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Demo SQL Injection</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #222; color: #fff; }
        pre { background: #333; padding: 15px; border-radius: 5px; color: #50fa7b; }
        h2 { border-bottom: 1px solid #555; padding-bottom: 5px; }
    </style>
</head>
<body>
    <h1>Pengujian Keamanan SQL Injection</h1>
    <p>URL Parameter: <code>?email=<?= e($email) ?></code></p>

    <h2 style="color: #ff5555;">1. Versi BERBAHAYA (Hasil: <?= count($hasilBahaya) ?> baris)</h2>
    <pre><?= e(print_r($hasilBahaya, true)) ?></pre>

    <h2 style="color: #50fa7b;">2. Versi AMAN / Prepared Statement (Hasil: <?= count($hasilAman) ?> baris)</h2>
    <pre><?= e(print_r($hasilAman, true)) ?></pre>
</body>
</html>