<?php
declare(strict_types=1);

// Memulai session PHP jika belum berjalan
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load koneksi database & helper
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/helpers.php';

// Pengaturan penanganan error sederhana
$config = require __DIR__ . '/../config/config.php';
if ($config['app']['debug']) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}