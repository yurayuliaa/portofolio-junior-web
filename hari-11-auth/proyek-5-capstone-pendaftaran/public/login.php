<?php
declare(strict_types=1);

require_once __DIR__ . '/../src/bootstrap.php'; // Pakai /../ untuk keluar dari public/

if (!empty($_SESSION['admin_id'])) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $sandi = $_POST['sandi'] ?? '';

    if (empty($username) || empty($sandi)) {
        $error = 'Username dan kata sandi wajib diisi.';
    } else {
        $pdo = getConnection();
        if (prosesLogin($pdo, $username, $sandi)) {
            redirect('index.php');
        } else {
            $error = 'Username atau kata sandi salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        body { font-family: sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 360px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #0d6efd; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #0b5ed7; }
        .error { background: #f8d7da; color: #842029; padding: 10px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c2c7; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Login Admin</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="sandi">Kata Sandi</label>
                <input type="password" id="sandi" name="sandi" required>
            </div>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>