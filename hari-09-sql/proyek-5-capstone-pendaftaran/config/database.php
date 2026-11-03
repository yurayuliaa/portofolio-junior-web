<?php
declare(strict_types=1);

function getConnection(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $configFile = __DIR__ . '/config.php';
        
        if (!file_exists($configFile)) {
            throw new RuntimeException('File config/config.php belum dibuat. Salin dari config.contoh.php terlebih dahulu.');
        }

        $config = require $configFile;
        $db = $config['db'];

        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $db['host'], $db['name'], $db['charset']);

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    return $pdo;
}