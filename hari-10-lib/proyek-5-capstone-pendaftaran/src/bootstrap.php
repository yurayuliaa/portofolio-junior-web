<?php

declare(strict_types=1);

session_start();

$konfigurasi = require __DIR__ . '/../config/config.php';

$isDebug = (bool) ($konfigurasi['debug'] ?? true);
ini_set('display_errors', $isDebug ? '1' : '0');
error_reporting(E_ALL);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/pendaftar.php';

set_exception_handler(function (Throwable $e) use ($isDebug): void {
    error_log($e->getMessage());
    http_response_code(500);
    if ($isDebug) {
        echo '<div style="background:#f8d7da; color:#842029; padding:20px; margin:20px; border-radius:8px; font-family:sans-serif; border:1px solid #f5c2c7;">';
        echo '<h3 style="margin-top:0;">⚠️ Detail Eror Sistem:</h3>';
        echo '<strong>Pesan Eror:</strong> ' . htmlspecialchars($e->getMessage()) . '<br><br>';
        echo '<strong>Berkas:</strong> ' . htmlspecialchars($e->getFile()) . ' (baris ' . $e->getLine() . ')';
        echo '</div>';
    } else {
        echo 'Terjadi kesalahan pada sistem. Silakan coba lagi.';
    }
});
