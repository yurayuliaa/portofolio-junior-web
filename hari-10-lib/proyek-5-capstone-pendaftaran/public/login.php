<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php';
$hash = password_hash('admin123', PASSWORD_DEFAULT);  // simpan hash di basis data
$id=1;
$pdo = getConnection();
$admin = ambilAdminById($pdo, $id);
echo "<p> $hash </p>";
echo "<p>".$admin['password_hash']."</p>";


if (!empty($_SESSION['admin_login'])) {
    redirect('admin.php');
}

$galat = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cekCsrf();
    // Contoh sederhana (hardcode). Pada sistem nyata, cocokkan dengan database.
    $password = $_POST['password'] ?? '';

//if ($password === 'admin123')

$hash = password_hash('admin123', PASSWORD_DEFAULT); // simpan hash di basis data
if (password_verify($password, $hash)) 
    { 
        $_SESSION['admin_login'] = true;
        redirect('admin.php');
    } else {
        $galat['umum'] = 'Password salah.';
    }
}

$judul = 'Login Admin';
require __DIR__ . '/../templates/header.php';
?>
<h2>Login Admin</h2>

<?php $flash = ambilFlash(); if ($flash): ?>
    <p style="color: blue;"><?= e($flash) ?></p>
<?php endif; ?>
<?php if (isset($galat['umum'])): ?>
    <p style="color: red;"><?= e($galat['umum']) ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="csrf" value="<?= e(tokenCsrf()) ?>">
    <p>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required>
    </p>
    <button type="submit">Login</button>
</form>

<?php require __DIR__ . '/../templates/footer.php'; ?>