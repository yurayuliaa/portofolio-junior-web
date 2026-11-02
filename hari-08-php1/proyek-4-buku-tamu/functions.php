<?php

declare(strict_types=1);

const FILE_TAMU = __DIR__ . '/data/tamu.json';
const MAKS_PESAN = 500;
const MIN_NAMA = 3;
const MAKS_NAMA = 100;

/**
 * Meng-escape teks agar aman ditampilkan di HTML (mencegah XSS).
 */
function e(string $teks): string
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

/**
 * Mengganti spasi/tab/baris baru berurutan menjadi satu spasi.
 */
function bersihkanSpasi(string $teks): string
{
    return trim((string) preg_replace('/\s+/', ' ', $teks));
}

/**
 * Memvalidasi input buku tamu.
 *
 * @param array<string, mixed> $input Data mentah (biasanya $_POST).
 * @return array{data: array<string, string>, galat: array<string, string>}
 */
function validasiTamu(array $input): array
{
    $data = [
        'nama' => bersihkanSpasi((string) ($input['nama'] ?? '')),
        'email' => trim((string) ($input['email'] ?? '')),
        'pesan' => trim((string) ($input['pesan'] ?? '')),
    ];
    $galat = [];

    $panjangNama = mb_strlen($data['nama']);
    if ($panjangNama < MIN_NAMA || $panjangNama > MAKS_NAMA) {
        $galat['nama'] = 'Nama harus ' . MIN_NAMA . '-' . MAKS_NAMA . ' karakter.';
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $galat['email'] = 'Format email tidak valid.';
    }
    $panjangPesan = mb_strlen($data['pesan']);
    if ($panjangPesan === 0 || $panjangPesan > MAKS_PESAN) {
        $galat['pesan'] = 'Pesan wajib diisi, maksimal ' . MAKS_PESAN . ' karakter.';
    }

    return ['data' => $data, 'galat' => $galat];
}

/**
 * Membaca semua pesan tamu dari berkas JSON.
 *
 * Berkas belum ada berarti belum ada pesan. Berkas ada tetapi rusak dilaporkan
 * sebagai error supaya data lama tidak tertimpa tanpa sengaja.
 *
 * @return array<int, array<string, mixed>>
 * @throws RuntimeException bila berkas tidak terbaca atau JSON rusak.
 */
function ambilSemuaTamu(): array
{
    if (!file_exists(FILE_TAMU)) {
        return [];
    }
    $isi = file_get_contents(FILE_TAMU);
    if ($isi === false) {
        throw new RuntimeException('Berkas data tidak dapat dibaca.');
    }
    if (trim($isi) === '') {
        return [];
    }
    $daftar = json_decode($isi, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($daftar)) {
        throw new RuntimeException('Berkas data rusak: ' . json_last_error_msg());
    }

    return $daftar;
}

/**
 * Menyimpan satu pesan baru (id dan waktu ditambahkan otomatis).
 *
 * @param array<string, string> $data Data tervalidasi.
 * @return bool true bila berhasil disimpan.
 * @throws RuntimeException bila data lama tidak dapat dibaca.
 */
function simpanTamu(array $data): bool
{
    $folder = dirname(FILE_TAMU);
    if (!is_dir($folder) && !mkdir($folder, 0755, true)) {
        return false;
    }

    $daftar = ambilSemuaTamu();
    $data['id'] = $daftar === [] ? 1 : max(array_column($daftar, 'id')) + 1;
    $data['waktu'] = date('Y-m-d H:i:s');
    $daftar[] = $data;

    $json = json_encode($daftar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    return $json !== false && file_put_contents(FILE_TAMU, $json, LOCK_EX) !== false;
}

/**
 * Mencari pesan berdasarkan sebagian nama (tanpa peka huruf besar-kecil).
 *
 * @param array<int, array<string, mixed>> $daftar
 * @return array<int, array<string, mixed>>
 */
function cariTamu(array $daftar, string $kata): array
{
    if ($kata === '') {
        return $daftar;
    }

    return array_values(array_filter(
        $daftar,
        fn (array $tamu): bool => mb_stripos((string) $tamu['nama'], $kata, 0, 'UTF-8') !== false
    ));
}