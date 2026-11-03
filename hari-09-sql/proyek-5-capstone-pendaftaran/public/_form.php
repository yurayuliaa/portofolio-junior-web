<?php
// Pastikan variabel penampung data & error sudah ada
$pendaftar = $pendaftar ?? [];
$errors = $errors ?? [];
$listKelas = $listKelas ?? [];
?>

<form action="" method="POST">
    <!-- Token CSRF untuk Keamanan -->
    <input type="hidden" name="csrf_token" value="<?= e(generateCsrfToken()) ?>">

    <div class="form-group">
        <label for="nama">Nama Lengkap *</label>
        <input type="text" id="nama" name="nama" value="<?= e($pendaftar['nama'] ?? '') ?>">
        <?php if (isset($errors['nama'])): ?>
            <span class="error-text"><?= e($errors['nama']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Alamat Email *</label>
        <input type="email" id="email" name="email" value="<?= e($pendaftar['email'] ?? '') ?>">
        <?php if (isset($errors['email'])): ?>
            <span class="error-text"><?= e($errors['email']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="no_hp">Nomor HP *</label>
        <input type="text" id="no_hp" name="no_hp" value="<?= e($pendaftar['no_hp'] ?? '') ?>">
        <?php if (isset($errors['no_hp'])): ?>
            <span class="error-text"><?= e($errors['no_hp']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="kelas_id">Pilihan Kelas *</label>
        <select id="kelas_id" name="kelas_id">
            <option value="">-- Pilih Kelas --</option>
            <?php foreach ($listKelas as $k): ?>
                <?php 
                    $selected = ((int)($pendaftar['kelas_id'] ?? 0) === (int)$k['id']) ? 'selected' : ''; 
                ?>
                <option value="<?= e((string)$k['id']) ?>" <?= $selected ?>>
                    <?= e($k['nama_kelas']) ?> (Kuota: <?= e((string)$k['kuota']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['kelas_id'])): ?>
            <span class="error-text"><?= e($errors['kelas_id']) ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="3"><?= e($pendaftar['alamat'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn">Simpan Data</button>
    <a href="index.php" style="margin-left: 10px; color: #555; text-decoration: none;">Batal</a>
</form>