<?php

declare(strict_types=1);

// 1. Sanitasi Output (XSS Protection)
function e(?string $teks): string
{
    return htmlspecialchars($teks ?? '', ENT_QUOTES, 'UTF-8');
}

// 2. Helper Redirect Halaman
function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

// 3. Generator Token CSRF (Mendukung tokenCsrf & generateCsrfToken)
function tokenCsrf(): string
{
    if (empty($_SESSION['csrf'])) {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf'] = $token;
        $_SESSION['csrf_token'] = $token;
    }
    return $_SESSION['csrf'];
}

function generateCsrfToken(): string
{
    return tokenCsrf();
}

// 4. Verifikasi Token CSRF (Satu fungsi fleksibel untuk semua kasus)
function verifyCsrfToken(?string $token = null): bool
{
    $sessionToken = $_SESSION['csrf'] ?? $_SESSION['csrf_token'] ?? '';
    
    // Ambil token dari parameter jika ada, atau cari di $_POST['csrf_token'] / $_POST['csrf']
    $inputToken = (!empty($token)) ? $token : ($_POST['csrf_token'] ?? $_POST['csrf'] ?? '');

    if (empty($sessionToken) || empty($inputToken)) {
        return false;
    }
    return hash_equals((string) $sessionToken, (string) $inputToken);
}

function cekCsrf(): bool
{
    return verifyCsrfToken();
}

// 5. Pesan Flash (Mendukung 1 atau 2 parameter)
function setFlash(string $param1, ?string $param2 = null): void
{
    if ($param2 !== null) {
        $_SESSION['flash'] = [
            'type'    => $param1,
            'message' => $param2
        ];
    } else {
        $_SESSION['flash'] = $param1;
    }
}

function ambilFlash()
{
    $pesan = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $pesan;
}

function getFlash()
{
    return ambilFlash();
}