<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= generateCsrfToken(); ?>">
            <div class="row">
                <!-- Kolom Nama -->
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" 
                           class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>" 
                           value="<?= e($pendaftar['nama'] ?? '') ?>">
                    <?php if (isset($errors['nama'])): ?>
                        <div class="invalid-feedback"><?= e($errors['nama']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Email -->
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" id="email" name="email" 
                           class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                           value="<?= e($pendaftar['email'] ?? '') ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= e($errors['email']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <!-- Kolom No HP -->
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" 
                           class="form-control <?= isset($errors['no_hp']) ? 'is-invalid' : '' ?>" 
                           value="<?= e($pendaftar['no_hp'] ?? '') ?>">
                    <?php if (isset($errors['no_hp'])): ?>
                        <div class="invalid-feedback"><?= e($errors['no_hp']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Pilihan Kelas -->
                <div class="col-md-6 mb-3">
                    <label for="kelas_id" class="form-label">Pilihan Kelas Pelatihan</label>
                    <select id="kelas_id" name="kelas_id" 
                            class="form-select <?= isset($errors['kelas_id']) ? 'is-invalid' : '' ?>">
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($listKelas as $k): ?>
                            <option value="<?= (int) $k['id'] ?>" 
                                <?= ((int)($pendaftar['kelas_id'] ?? 0) === (int)$k['id']) ? 'selected' : '' ?>>
                                <?= e($k['nama_kelas']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['kelas_id'])): ?>
                        <div class="invalid-feedback"><?= e($errors['kelas_id']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Kolom Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" class="form-control"><?= e($pendaftar['alamat'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>