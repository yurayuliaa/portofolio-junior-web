<?php

declare(strict_types=1);

require_once __DIR__ . '/../fungsi_pendukung/dev.php';
require_once __DIR__ . '/../fungsi_pendukung/lib-peserta.php';

const CM_PER_METER = 100;
const BATAS_BMI_KURANG = 18.5;
const BATAS_BMI_NORMAL = 25;
const BATAS_BMI_LEBIH = 30;

/**
 * Menghitung Body Mass Index.
 */
function hitungBmi(float $berat, float $tinggiCm): float
{
    $tinggiM = $tinggiCm / CM_PER_METER;

    return $berat / ($tinggiM * $tinggiM);
}

/**
 * Kategori BMI.
 */
function kategoriBmi(float $bmi): string
{
    return match (true) {
        $bmi < BATAS_BMI_KURANG => 'Kurang',
        $bmi < BATAS_BMI_NORMAL => 'Normal',
        $bmi < BATAS_BMI_LEBIH => 'Lebih',
        default => 'Obesitas',
    };
}

/**
 * Apakah teks adalah angka desimal lebih dari 0?
 */
function adalahAngkaPositif(string $teks): bool
{
    return filter_var($teks, FILTER_VALIDATE_FLOAT) !== false && (float) $teks > 0;
}

$galat = [];
$hasil = null;
$berat = trim((string) ($_POST['berat'] ?? ''));
$tinggi = trim((string) ($_POST['tinggi'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!adalahAngkaPositif($berat)) {
        $galat['berat'] = 'Berat harus angka lebih dari 0.';
    }
    if (!adalahAngkaPositif($tinggi)) {
        $galat['tinggi'] = 'Tinggi harus angka lebih dari 0.';
    }
    if ($galat === []) {
        $bmi = hitungBmi((float) $berat, (float) $tinggi);
        $hasil = number_format($bmi, 1) . ' (' . kategoriBmi($bmi) . ')';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator BMI</title>
</head>
<body>
    <h1>Kalkulator BMI</h1>
    <form method="post">
        <p>
            <label for="berat">Berat (kg)</label>
            <input id="berat" name="berat" value="<?= e($berat) ?>">
            <?php if (isset($galat['berat'])): ?>
                <span role="alert"><?= e($galat['berat']) ?></span>
            <?php endif; ?>
        </p>
        <p>
            <label for="tinggi">Tinggi (cm)</label>
            <input id="tinggi" name="tinggi" value="<?= e($tinggi) ?>">
            <?php if (isset($galat['tinggi'])): ?>
                <span role="alert"><?= e($galat['tinggi']) ?></span>
            <?php endif; ?>
        </p>
        <button type="submit">Hitung</button>
    </form>
    <?php if ($hasil !== null): ?>
        <p>Hasil BMI: <strong><?= e($hasil) ?></strong></p>
    <?php endif; ?>
</body>
</html>