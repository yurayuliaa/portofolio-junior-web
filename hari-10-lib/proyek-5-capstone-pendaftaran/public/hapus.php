<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/pendaftar.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('405 Method Not Allowed: Akses hanya diizinkan melalui metode POST.');
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
    http_response_code(403);
    exit('403 Forbidden: Token CSRF tidak valid.');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    setFlash('danger', 'ID pendaftar tidak valid.');
    redirect('index.php');
}

$pdo = getConnection();

if (deletePendaftar($pdo, (int)$id)) {
    setFlash('success', 'Data pendaftar berhasil dihapus.');
} else {
    setFlash('danger', 'Gagal menghapus data pendaftar.');
}

redirect('index.php');