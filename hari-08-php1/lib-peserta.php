<?php

declare(strict_types=1);

const BATAS_LULUS = 70;
const BATAS_GRADE_A = 85;
const BATAS_GRADE_B = 70;
const BATAS_GRADE_C = 55;

/**
 * Meng-escape teks agar aman ditampilkan di HTML (mencegah XSS).
 */
function e(string $teks): string
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

/**
 * Data contoh peserta.
 *
 * @return array<int, array{nama: string, kelas: string, nilai: int}>
 */
function ambilDataPeserta(): array
{
    return [
        ['nama' => 'Sari', 'kelas' => 'Web', 'nilai' => 90],
        ['nama' => 'Budi', 'kelas' => 'Web', 'nilai' => 68],
        ['nama' => 'Citra', 'kelas' => 'Data', 'nilai' => 82],
        ['nama' => 'Dewi', 'kelas' => 'Data', 'nilai' => 75],
        ['nama' => 'Eka', 'kelas' => 'Web', 'nilai' => 55],
    ];
}

/**
 * Mengubah nilai menjadi grade huruf.
 */
function tentukanGrade(int $nilai): string
{
    return match (true) {
        $nilai >= BATAS_GRADE_A => 'A',
        $nilai >= BATAS_GRADE_B => 'B',
        $nilai >= BATAS_GRADE_C => 'C',
        default => 'D',
    };
}

/**
 * Menghitung rata-rata nilai dari daftar peserta (0.0 bila kosong).
 *
 * @param array<int, array{nilai: int}> $daftar
 */
function hitungRataRata(array $daftar): float
{
    if ($daftar === []) {
        return 0.0;
    }

    return array_sum(array_column($daftar, 'nilai')) / count($daftar);
}

/**
 * Mencari peserta dengan nilai tertinggi (null bila daftar kosong).
 *
 * @param array<int, array{nilai: int}> $daftar
 * @return array<string, mixed>|null
 */
function cariTertinggi(array $daftar): ?array
{
    if ($daftar === []) {
        return null;
    }
    $tertinggi = $daftar[array_key_first($daftar)];
    foreach ($daftar as $peserta) {
        if ($peserta['nilai'] > $tertinggi['nilai']) {
            $tertinggi = $peserta;
        }
    }

    return $tertinggi;
}

/**
 * Menyaring peserta yang nilainya mencapai batas.
 *
 * @param array<int, array{nilai: int}> $peserta
 * @return array<int, array{nilai: int}>
 */
function filterLulus(array $peserta, int $batas = BATAS_LULUS): array
{
    return array_values(array_filter(
        $peserta,
        fn (array $p): bool => $p['nilai'] >= $batas
    ));
}

/**
 * Mengurutkan peserta dari nilai tertinggi (mengembalikan salinan).
 *
 * @param array<int, array{nilai: int}> $peserta
 * @return array<int, array{nilai: int}>
 */
function urutkanNilai(array $peserta): array
{
    usort($peserta, fn (array $a, array $b): int => $b['nilai'] <=> $a['nilai']);

    return $peserta;
}

/**
 * Mengelompokkan peserta per kelas.
 *
 * @param array<int, array{kelas: string}> $peserta
 * @return array<string, array<int, array<string, mixed>>>
 */
function kelompokkanPerKelas(array $peserta): array
{
    $hasil = [];
    foreach ($peserta as $p) {
        $hasil[$p['kelas']][] = $p;
    }

    return $hasil;
}

/**
 * Membuat tabel HTML (nomor, nama, kelas, nilai, grade); semua output di-escape.
 *
 * @param array<int, array{nama: string, kelas: string, nilai: int}> $daftar
 */
function buatTabelPeserta(array $daftar): string
{
    if ($daftar === []) {
        return '<p>Tidak ada data.</p>';
    }
    $html = '<table border="1" cellpadding="6"><tr><th>No</th><th>Nama</th><th>Kelas</th>'
        . '<th>Nilai</th><th>Grade</th></tr>';
    foreach (array_values($daftar) as $indeks => $p) {
        $html .= '<tr><td>' . ($indeks + 1) . '</td><td>' . e($p['nama']) . '</td><td>' . e($p['kelas'])
            . '</td><td>' . $p['nilai'] . '</td><td>' . e(tentukanGrade($p['nilai'])) . '</td></tr>';
    }

    return $html . '</table>';
}