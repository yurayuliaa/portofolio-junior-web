<?php
/**
 * Modul     : Auth (src/auth.php)
 * ID Modul  : MOD-AUT-001
 * Deskripsi : Autentikasi dan otorisasi admin berbasis sesi dan password_hash.
 * Dependensi: config/database.php (PDO), src/helpers.php
 *
 * @package PendaftaranPelatihan
 * @author  Rahma <rahma@contoh.com>
 * @version 1.0.1
 * @since   1.0.0
 */

declare(strict_types=1);

/**
 * Mencari data admin berdasarkan username.
 *
 * @param PDO    $pdo      Koneksi database aktif.
 * @param string $username Username yang dicari.
 *
 * @return array<string, mixed>|null Baris data admin atau null jika tidak ditemukan.
 */
function cariAdmin(PDO $pdo, string $username): ?array
{
    $stmt = $pdo->prepare('SELECT id, username, password_hash FROM admin WHERE username = :u');
    $stmt->execute(['u' => $username]);
    $baris = $stmt->fetch();
    return $baris === false ? null : $baris;
}

/**
 * Memeriksa kredensial admin dan memulai sesi bila benar.
 *
 * Efek samping: meregenerasi ID sesi dan mengisi $_SESSION['admin_id'].
 *
 * @param PDO    $pdo      Koneksi database aktif.
 * @param string $username Username yang dikirim dari form.
 * @param string $sandi    Kata sandi polos dari form.
 *
 * @return bool true bila login berhasil, false bila username atau sandi salah.
 */
function prosesLogin(PDO $pdo, string $username, string $sandi): bool
{
    $admin = cariAdmin($pdo, $username);
    if ($admin === null || !password_verify($sandi, $admin['password_hash'])) {
        return false;
    }

    session_regenerate_id(true); // Cegah Session Fixation
    $_SESSION['admin_id'] = (int) $admin['id'];
    $_SESSION['admin_username'] = $admin['username'];
    return true;
}

/**
 * Memastikan halaman hanya bisa diakses oleh admin yang sudah login.
 * Jika belum login, pengguna akan di-redirect ke login.php.
 *
 * @return void
 */
function wajibLogin(): void
{
    if (empty($_SESSION['admin_id'])) {
        redirect('login.php');
    }
}

/**
 * Menghapus sesi login admin dan membersihkan cookie sesi.
 *
 * @return void
 */
function logout(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(
            session_name(), '', time() - 42000,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']
        );
    }
    session_destroy();
}