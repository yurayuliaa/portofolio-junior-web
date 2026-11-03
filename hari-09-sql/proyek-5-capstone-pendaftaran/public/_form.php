<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="csrf" value="<?= e(tokenCsrf()) ?>">

            <div class="row">
                <!-- Kolom Nama -->
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" 
                           class="form-control <?= isset($galat['nama']) ? 'is-invalid' : '' ?>" 
                           value="<?= e($lama['nama'] ?? '') ?>">
                    <?php if (isset($galat['nama'])): ?>
                        <div class="invalid-feedback"><?= e($galat['nama']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Email -->
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" id="email" name="email" 
                           class="form-control <?= isset($galat['email']) ? 'is-invalid' : '' ?>" 
                           value="<?= e($lama['email'] ?? '') ?>">
                    <?php if (isset($galat['email'])): ?>
                        <div class="invalid-feedback"><?= e($galat['email']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <!-- Kolom No HP -->
                <div class="col-md-6 mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" 
                           class="form-control <?= isset($galat['no_hp']) ? 'is-invalid' : '' ?>" 
                           value="<?= e($lama['no_hp'] ?? '') ?>">
                    <?php if (isset($galat['no_hp'])): ?>
                        <div class="invalid-feedback"><?= e($galat['no_hp']) ?></div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Pilihan Kelas -->
                <div class="col-md-6 mb-3">
                    <label for="kelas_id" class="form-label">Pilihan Kelas Pelatihan</label>
                    <select id="kelas_id" name="kelas_id" 
                            class="form-select <?= isset($galat['kelas_id']) ? 'is-invalid' : '' ?>">
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($kelas as $k): ?>
                            <option value="<?= (int) $k['id'] ?>" 
                                <?= ((int)($lama['kelas_id'] ?? 0) === (int)$k['id']) ? 'selected' : '' ?>>
                                <?= e($k['nama_kelas']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($galat['kelas_id'])): ?>
                        <div class="invalid-feedback"><?= e($galat['kelas_id']) ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Kolom Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" class="form-control"><?= e($lama['alamat'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>