<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';

$pdo = getConnection();
$daftar = ambilSemuaPendaftar($pdo);

$judul = 'Daftar Pendaftar';
require_once __DIR__ . '/../templates/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 fw-bold mb-0">Daftar Pendaftar Pelatihan</h2>
    <a href="tambah.php" class="btn btn-primary">+ Tambah Pendaftar</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabelPendaftar" class="table table-striped table-hover align-middle w-100">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Kelas</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar as $p): ?>
                        <tr>
                            <td><?= (int) $p['id'] ?></td>
                            <td class="fw-semibold"><?= e($p['nama']) ?></td>
                            <td><?= e($p['email']) ?></td>
                            <td><?= e($p['no_hp']) ?></td>
                            <td><span class="badge bg-info text-dark"><?= e($p['nama_kelas']) ?></span></td>
                            <td class="text-center">
                                <a href="ubah.php?id=<?= (int) $p['id'] ?>" class="btn btn-sm btn-warning">Ubah</a>

                                <!-- Tombol Cetak PDF Bukti Pendaftaran -->
                                <a href="cetak.php?id=<?= (int) $p['id'] ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Cetak</a>

                                <form method="POST" action="hapus.php" class="form-hapus d-inline" data-nama="<?= e($p['nama']) ?>">
                                    <input type="hidden" name="csrf" value="<?= e(tokenCsrf()) ?>">
                                    <input type="hidden" name="id" value="<?= (int) $p['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>