<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$pdo = getConnection();
$kelas = daftarKelas($pdo);

$lama = ['nama' => '', 'email' => '', 'no_hp' => '', 'alamat' => '', 'kelas_id' => 0];
$galat = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cekCsrf();
    $hasil = validasiPendaftar($_POST, $pdo, null);
    $lama = $hasil['data'];
    $galat = $hasil['galat'];

    if ($galat === []) {
        tambahPendaftar($pdo, $lama);
        setFlash('Pendaftaran berhasil! Terima kasih telah mendaftar.');
        redirect('daftar.php');
    }
}

$judul = 'Pendaftaran Pelatihan Publik';
require_once __DIR__ . '/../templates/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="h3 fw-bold mb-3 text-center">Formulir Pendaftaran Pelatihan</h2>
        <?php require_once __DIR__ . '/_form.php'; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>