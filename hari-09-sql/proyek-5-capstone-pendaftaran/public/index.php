<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/pendaftar.php';

$pdo = getConnection();

// 1. Tangkap Parameter Pencarian & Paginasi
$search = trim($_GET['search'] ?? '');
$page = filter_var($_GET['page'] ?? 1, FILTER_VALIDATE_INT) ?: 1;
if ($page < 1) {
    $page = 1;
}

$limit = 5; // Menampilkan 5 data per halaman
$offset = ($page - 1) * $limit;

// 2. Ambil Data Pendaftar & Total Data untuk Paginasi
$totalData = getTotalPendaftar($pdo, $search);
$totalPages = (int) ceil($totalData / $limit);
$pendaftarList = getAllPendaftar($pdo, $search, $limit, $offset);

// 3. Ambil Pesan Flash (jika ada)
$flash = getFlash();

require_once __DIR__ . '/../templates/header.php';
?>

<h2>Daftar Pendaftar Pelatihan</h2>

<!-- Tampilkan Pesan Flash (Sukses/Gagal) -->
<?php if ($flash): ?>
    <div class="alert alert-<?= e($flash['type']) ?>">
        <?= e($flash['message']) ?>
    </div>
<?php endif; ?>

<!-- Bar Tool: Tombol Tambah & Form Pencarian -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <a href="tambah.php" class="btn">+ Tambah Pendaftar</a>

    <form action="index.php" method="GET" style="display: flex; gap: 5px;">
        <input type="text" name="search" placeholder="Cari nama atau email..." value="<?= e($search) ?>" style="padding: 6px;">
        <button type="submit" class="btn" style="background: #6c757d;">Cari</button>
        <?php if ($search !== ''): ?>
            <a href="index.php" class="btn" style="background: #dc3545; color: white; text-decoration: none;">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- Tabel Data Pendaftar -->
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Kelas</th>
            <th>Tgl Daftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($pendaftarList)): ?>
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data pendaftar.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($pendaftarList as $index => $item): ?>
                <tr>
                    <td><?= $offset + $index + 1 ?></td>
                    <td><?= e($item['nama']) ?></td>
                    <td><?= e($item['email']) ?></td>
                    <td><?= e($item['no_hp']) ?></td>
                    <td><?= e($item['nama_kelas']) ?></td>
                    <td><?= e(date('d/m/Y H:i', strtotime($item['tgl_daftar']))) ?></td>
                    <td>
                        <a href="ubah.php?id=<?= e((string)$item['id']) ?>" class="btn btn-warning" style="padding: 4px 8px; font-size: 0.85rem;">Ubah</a>

                        <!-- Form Hapus Aman (Method POST + CSRF Token) -->
                        <form action="hapus.php" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            <input type="hidden" name="csrf_token" value="<?= e(generateCsrfToken()) ?>">
                            <input type="hidden" name="id" value="<?= e((string)$item['id']) ?>">
                            <button type="submit" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.85rem;">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<!-- Paginasi Halaman -->
<?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i === $page): ?>
                <strong><?= $i ?></strong>
            <?php else: ?>
                <a href="index.php?page=<?= $i ?><?= $search !== '' ? '&search=' . urlencode($search) : '' ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>