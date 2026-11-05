<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    exit('Hanya dapat dijalankan dari terminal.' . PHP_EOL);
}

require_once __DIR__ . '/../config/database.php';

$username = $argv[1] ?? '';
$sandi = $argv[2] ?? '';

if (strlen($username) < 3 || strlen($sandi) < 8) {
    exit('Gunakan: php database/buat-admin.php <username> <sandi minimal 8 karakter>' . PHP_EOL);
}

$pdo = getConnection();

// Buat tabel admin jika belum ada
$pdo->exec("CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$stmt = $pdo->prepare('INSERT INTO admin (username, password_hash) VALUES (:u, :p)');
try {
    $stmt->execute([
        'u' => $username,
        'p' => password_hash($sandi, PASSWORD_DEFAULT)
    ]);
    echo 'Admin berhasil dibuat.' . PHP_EOL;
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        echo 'Error: Username sudah digunakan.' . PHP_EOL;
    } else {
        echo 'Error: ' . $e->getMessage() . PHP_EOL;
    }
}