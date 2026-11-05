<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/pendaftar.php';

$pdo = getConnection();
$errors = [];
$pendaftar = [];
$listKelas = getAllKelas($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifikasi Token CSRF
    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        exit('403 Forbidden: Token CSRF tidak valid.');
    }

    $pendaftar = $_POST;
    $errors = validatePendaftar($pdo, $pendaftar);

    if (empty($errors)) {
        if (insertPendaftar($pdo, $pendaftar)) {
            setFlash('success', 'Data pendaftar berhasil ditambahkan!');
            redirect('index.php');
        } else {
            setFlash('danger', 'Gagal menyimpan data.');
        }
    }
}

require_once __DIR__ . '/../templates/header.php';
?>

<h2>Tambah Pendaftar Baru</h2>

<?php require_once __DIR__ . '/_form.php'; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>