<?php

declare(strict_types=1);

// 1. Ambil daftar pendaftar (lengkap dengan filter pencarian dan paginasi)
function getAllPendaftar(PDO $pdo, string $search = '', int $limit = 10, int $offset = 0): array
{
    $sql = 'SELECT p.*, k.nama_kelas 
            FROM pendaftar p 
            JOIN kelas k ON k.id = p.kelas_id ';

    if ($search !== '') {
        $sql .= 'WHERE p.nama LIKE :search_nama OR p.email LIKE :search_email ';
    }

    $sql .= 'ORDER BY p.tgl_daftar DESC, p.id DESC LIMIT :limit OFFSET :offset';

    $stmt = $pdo->prepare($sql);

    if ($search !== '') {
        $searchTerm = '%' . $search . '%';
        $stmt->bindValue(':search_nama', $searchTerm, PDO::PARAM_STR);
        $stmt->bindValue(':search_email', $searchTerm, PDO::PARAM_STR);
    }

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll();
}

// 2. Hitung jumlah total pendaftar
function getTotalPendaftar(PDO $pdo, string $search = ''): int
{
    $sql = 'SELECT COUNT(p.id) FROM pendaftar p ';

    if ($search !== '') {
        $sql .= 'WHERE p.nama LIKE :search_nama OR p.email LIKE :search_email';
    }

    $stmt = $pdo->prepare($sql);

    if ($search !== '') {
        $searchTerm = '%' . $search . '%';
        $stmt->bindValue(':search_nama', $searchTerm, PDO::PARAM_STR);
        $stmt->bindValue(':search_email', $searchTerm, PDO::PARAM_STR);
    }

    $stmt->execute();
    return (int) $stmt->fetchColumn();
}

// 3. Ambil data 1 pendaftar berdasarkan ID
function getPendaftarById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare('SELECT * FROM pendaftar WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch();
    return $result ?: null;
}

// 4. Ambil semua kelas (untuk dropdown opsi pilihan kelas di form)
function getAllKelas(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT * FROM kelas ORDER BY nama_kelas ASC');
    return $stmt->fetchAll();
}

// 5. Validasi input form pendaftar
function validatePendaftar(PDO $pdo, array $data, ?int $currentId = null): array
{
    $errors = [];

    // Validasi Nama
    $nama = trim($data['nama'] ?? '');
    if ($nama === '') {
        $errors['nama'] = 'Nama wajib diisi.';
    } elseif (mb_strlen($nama) < 3) {
        $errors['nama'] = 'Nama minimal 3 karakter.';
    }

    // Validasi Email
    $email = trim($data['email'] ?? '');
    if ($email === '') {
        $errors['email'] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid.';
    } else {
        // Cek apakah email sudah dipakai pengguna lain
        $sql = 'SELECT COUNT(id) FROM pendaftar WHERE email = :email';
        $params = ['email' => $email];

        if ($currentId !== null) {
            $sql .= ' AND id != :id';
            $params['id'] = $currentId;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        if ($stmt->fetchColumn() > 0) {
            $errors['email'] = 'Email sudah terdaftar.';
        }
    }

    // Validasi No HP
    $noHp = trim($data['no_hp'] ?? '');
    if ($noHp === '') {
        $errors['no_hp'] = 'Nomor HP wajib diisi.';
    }

    // Validasi Pilihan Kelas
    $kelasId = filter_var($data['kelas_id'] ?? null, FILTER_VALIDATE_INT);
    if (!$kelasId) {
        $errors['kelas_id'] = 'Pilih kelas yang valid.';
    }

    return $errors;
}

// 6. Simpan data pendaftar baru
function insertPendaftar(PDO $pdo, array $data): bool
{
    $sql = 'INSERT INTO pendaftar (nama, email, no_hp, alamat, kelas_id) 
            VALUES (:nama, :email, :no_hp, :alamat, :kelas_id)';

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'nama'     => trim($data['nama']),
        'email'    => trim($data['email']),
        'no_hp'    => trim($data['no_hp']),
        'alamat'   => trim($data['alamat'] ?? ''),
        'kelas_id' => (int) $data['kelas_id'],
    ]);
}

// 7. Perbarui data pendaftar
function updatePendaftar(PDO $pdo, int $id, array $data): bool
{
    $sql = 'UPDATE pendaftar 
            SET nama = :nama, email = :email, no_hp = :no_hp, alamat = :alamat, kelas_id = :kelas_id 
            WHERE id = :id';

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id'       => $id,
        'nama'     => trim($data['nama']),
        'email'    => trim($data['email']),
        'no_hp'    => trim($data['no_hp']),
        'alamat'   => trim($data['alamat'] ?? ''),
        'kelas_id' => (int) $data['kelas_id'],
    ]);
}

// 8. Hapus data pendaftar
function deletePendaftar(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare('DELETE FROM pendaftar WHERE id = :id');
    return $stmt->execute(['id' => $id]);
}
