<?php

declare(strict_types=1);
//Buat fungsi bertipe berikut dan uji hasilnya pada halaman HTML:
$peserta = [
    ['nama' => 'Sari', 'kelas' => 'Web', 'nilai' => 90],
    ['nama' => 'Budi', 'kelas' => 'Web', 'nilai' => 68],
    ['nama' => 'Citra', 'kelas' => 'Data', 'nilai' => 80],
];
//hitungRataRata(array $daftar): 

echo "<h3>Cari Rata </h3>";
function hitungRataRata(array $daftar): float
{
    $total = array_sum(array_column($daftar, 'nilai'));
    return $total / count($daftar);
}
$rataRata = hitungRataRata($peserta);
echo '<p>Rata-rata nilai: ' . $rataRata . '</p>';
//float dan cariTertinggi(array $daftar): ?array.
echo "<h3>Cari Nilai Tertinggi </h3>";
function cariTertinggi(array $daftar): ?array
{
    $maxNilai = max(array_column($daftar, 'nilai'));
    $result = array_filter($daftar, function ($item) use ($maxNilai) {
        return $item['nilai'] === $maxNilai;
    });
    return array_values($result)[0] ?? null;
}
$tertinggi = cariTertinggi($peserta);
if ($tertinggi) {
    echo '<p>Peserta dengan nilai tertinggi: ' . $tertinggi['nilai'] . ' adalah ' . $tertinggi['nama'] . '</p>';
} else {
    echo '<p>Tidak ada peserta.</p>';
}

//filterLulus(array $peserta, int $batas = 70): array dengan array_filter.
echo "<h3>Filter Lulus </h3>";
function filterNilaiLebihDari70(array $daftar): array
{
    $result = array_filter($daftar, function ($item) {
        return $item['nilai'] > 70;
    });
    // array_values digunakan untuk mereset index array menjadi berurutan dari 0
    return array_values($result);
}

$hasilFilter = filterNilaiLebihDari70($peserta);
//print_r($hasilFilter);

foreach ($hasilFilter as $siswa) {
    echo "Nama: " . $siswa['nama'] . " - Nilai: " . $siswa['nilai'] . "<br>";
}


//urutkanNilai(array $peserta): array dengan usort (kembalikan salinan). 
echo "<h3>Urutkan Nilai </h3>";
function urutkanNilai(array $peserta): array
{
    // Membuat salinan array
    $salinanPeserta = $peserta;

    // Mengurutkan salinan menggunakan usort
    usort($salinanPeserta, function ($a, $b) {
        // Mengurutkan dari nilai terbesar ke terkecil (Descending)
        // Jika ingin dari terkecil ke terbesar, gunakan: return $a['nilai'] <=> $b['nilai'];
        return $b['nilai'] <=> $a['nilai'];
    });

    return $salinanPeserta;
}
$pesertaTelahDiurutkan = urutkanNilai($peserta);
//echo "<p>".print_r($pesertaTelahDiurutkan)."<p>";
// Mencetak hasilnya
foreach ($pesertaTelahDiurutkan as $p) {
    echo "Nama: " . $p['nama'] .  " | Nilai: " . $p['nilai'] . "<br>";
}
//kelompokkan PerKelas(array $peserta): array yang menghasilkan ['Web' => [...], 'Data' => [...]].
function kelompokkanPerKelas(array $peserta): array {
    $hasil = [];
    
    foreach ($peserta as $p) {
        $kelas = $p['kelas'];
        // Memasukkan data peserta ke dalam array berdasarkan nama kelasnya
        $hasil[$kelas][] = $p;
    }
    return $hasil;
}

$dataPerKelas = kelompokkanPerKelas($peserta);
foreach ($dataPerKelas as $namaKelas => $daftarPeserta) { 
        // Cetak nama kelas sebagai judul (Heading)
        echo "<h3>Kelas " . $namaKelas . "</h3>";
        // Buat list HTML
        echo "<ul>";
        // Perulangan dalam: Mengambil setiap peserta di dalam kelas tersebut
        foreach ($daftarPeserta as $siswa) {
            echo "<li>Nama:" . $siswa['nama'] . " | Nilai: " . $siswa['nilai'] . "</li>";
        }
        // Tutup list HTML
        echo "</ul>";
        echo "<hr>"; // Garis pemisah antar kelas
    }

    foreach ($dataPerKelas as $namaKelas => $daftarPeserta) { 
        // Cetak nama kelas sebagai judul (Heading)
        echo "<h3>Kelas " . $namaKelas . "</h3>";
        // Buat list HTML
        echo "<table border='1'>";
        // Perulangan dalam: Mengambil setiap peserta di dalam kelas tersebut
        echo "<tr><th>Nama</th><th>Nilai</th></tr>";
        foreach ($daftarPeserta as $siswa) {
            echo "<tr><td>". htmlspecialchars($siswa['nama']) ."</td><td>" . $siswa['nilai'] . "</td></tr>";
        }
        // Tutup list HTML
        echo "</table>";
        echo "<hr>"; // Garis pemisah antar kelas
    }

/*

Tampilkan hasil dalam tabel HTML berisi nomor, nama, kelas, nilai, dan grade. Semua output di-escape dengan htmlspecialchars.

*/