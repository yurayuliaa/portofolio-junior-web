<?php

declare(strict_types=1);

// Uji fungsi tanpa browser. Jalankan: php uji.php
require_once __DIR__ . '/fungsi_pendukung/dev.php';
require_once __DIR__ . '/fungsi_pendukung/lib-peserta.php';

/**
 * Membandingkan nilai harapan dan hasil, lalu mencetak LULUS/GAGAL.
 */
function periksa(string $nama, mixed $harapan, mixed $hasil): void
{
    $lulus = $harapan === $hasil;
    echo ($lulus ? 'LULUS  ' : 'GAGAL  ') . $nama . PHP_EOL;
    if (!$lulus) {
        echo '       harapan: ' . json_encode($harapan) . ' | hasil: ' . json_encode($hasil) . PHP_EOL;
        exit(1);
    }
}

$data = ambilDataPeserta();
periksa('hitungRataRata', 74.0, hitungRataRata($data));
periksa('hitungRataRata kosong', 0.0, hitungRataRata([]));
periksa('cariTertinggi', 'Sari', cariTertinggi($data)['nama'] ?? null);
periksa('cariTertinggi kosong', null, cariTertinggi([]));
periksa('filterLulus (70)', ['Sari', 'Citra', 'Dewi'], array_column(filterLulus($data), 'nama'));
periksa('filterLulus (batas 80)', ['Sari', 'Citra'], array_column(filterLulus($data, 80), 'nama'));
periksa('urutkanNilai', ['Sari', 'Citra', 'Dewi', 'Budi', 'Eka'], array_column(urutkanNilai($data), 'nama'));
periksa('urutkanNilai tidak mengubah asli', 'Sari', $data[0]['nama']);
periksa('kelompokkanPerKelas', ['Web', 'Data'], array_keys(kelompokkanPerKelas($data)));
periksa('tentukanGrade', 'ABCD', tentukanGrade(90) . tentukanGrade(70) . tentukanGrade(55) . tentukanGrade(10));
periksa('e() mencegah XSS', '&lt;script&gt;alert(1)&lt;/script&gt;', e('<script>alert(1)</script>'));