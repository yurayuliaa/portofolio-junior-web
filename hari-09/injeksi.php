<?php
// Konfigurasi Database (Sesuaikan user dan password)
$host = '127.0.0.1';
$db   = 'db_pelatihan';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Mengambil input email dari URL (GET)
$inputEmail = $_GET['email'] ?? '';

echo "<h1>Demonstrasi SQL Injection</h1>";
echo "<p>Input Payload: <strong>" . htmlspecialchars($inputEmail) . "</strong></p><hr>";

// ==========================================
// 1. VERSI BERBAHAYA (String Concatenation)
// ==========================================
echo "<h2>1. Versi Berbahaya</h2>";
try {
    // Input digabungkan langsung ke dalam struktur query SQL
    $sqlRentan = "SELECT * FROM pendaftar WHERE email = '$inputEmail'";
    echo "Query: <code>" . htmlspecialchars($sqlRentan) . "</code><br>";

    $stmtRentan = $pdo->query($sqlRentan);
    $hasilRentan = $stmtRentan->fetchAll();

    echo "Ditemukan <strong>" . count($hasilRentan) . "</strong> data.<br>";
    foreach ($hasilRentan as $baris) {
        echo "- " . htmlspecialchars($baris['nama']) . " (" . htmlspecialchars($baris['email']) . ")<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

echo "<hr>";

// ==========================================
// 2. VERSI AMAN (Prepared Statements)
// ==========================================
echo "<h2>2. Versi Aman</h2>";
try {
    // Struktur SQL dipisahkan dari input menggunakan placeholder (?)
    $sqlAman = "SELECT * FROM pendaftar WHERE email = ?";
    echo "Query: <code>SELECT * FROM pendaftar WHERE email = ? </code> <em>(Binding Data Terpisah)</em><br>";

    $stmtAman = $pdo->prepare($sqlAman);
    // Input dikirim secara aman pada saat eksekusi
    $stmtAman->execute([$inputEmail]);
    $hasilAman = $stmtAman->fetchAll();

    echo "Ditemukan <strong>" . count($hasilAman) . "</strong> data.<br>";
    foreach ($hasilAman as $baris) {
        echo "- " . htmlspecialchars($baris['nama']) . " (" . htmlspecialchars($baris['email']) . ")<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
//coba : http://localhost/injeksi.php?email=x' OR '1'='1