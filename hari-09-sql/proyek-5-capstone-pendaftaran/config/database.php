<?php
declare(strict_types=1);

function getConnection(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $c = require __DIR__ . '/config.php';
        
        $dbHost   = $c['db']['host'] ?? $c['host'] ?? 'localhost';
        $dbName   = $c['db']['nama_db'] ?? $c['nama_db'] ?? 'db_pelatihan';
        $dbUser   = $c['db']['user'] ?? $c['user'] ?? 'root';
        $dbPass   = $c['db']['sandi'] ?? $c['sandi'] ?? '';
        $charset  = $c['db']['charset'] ?? 'utf8mb4';

        $dsn = "mysql:host={$dbHost};dbname={$dbName};charset={$charset}";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}