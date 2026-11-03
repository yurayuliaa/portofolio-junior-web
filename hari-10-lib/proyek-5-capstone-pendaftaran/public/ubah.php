<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/pendaftar.php';

$pdo = getConnection();

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(404);
    exit('404 Not Found: ID pendaftar tidak valid.');
}

$pendaftar = getPendaftarById($pdo, (int)$id);
if (!$pendaftar) {
    http_response_code(404);
    exit('404 Not Found: Data pendaftar tidak ditemukan.');
}

$errors = [];
$listKelas = getAllKelas($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? '')) {
        http_response_code(403);
        exit('403 Forbidden: Token CSRF tidak valid.');
    }

    $inputData = $_POST;
    $errors = validatePendaftar($pdo, $inputData, (int)$id);

    if (empty($errors)) {
        if (updatePendaftar($pdo, (int)$id, $inputData)) {
            setFlash('success', 'Data pendaftar berhasil diperbarui!');
            redirect('index.php');
        } else {
            setFlash('danger', 'Gagal memperbarui data.');
        }
    } else {
        $pendaftar = array_merge($pendaftar, $inputData);
    }
}

require_once __DIR__ . '/../templates/header.php';
?>

<h2>Ubah Data Pendaftar</h2>

<?php require_once __DIR__ . '/_form.php'; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>