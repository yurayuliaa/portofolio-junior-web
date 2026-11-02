<?php

declare(strict_types=1);

const FOLDER_DATA = __DIR__ . '/data';
const FILE_LOG = FOLDER_DATA . '/log.txt';
const MAKS_BARIS_LOG = 20;

/**
 * Memastikan folder ada; membuatnya bila belum.
 *
 * @throws RuntimeException bila folder tidak dapat dibuat.
 */
function pastikanFolder(string $folder): void
{
    if (!is_dir($folder) && !mkdir($folder, 0755, true) && !is_dir($folder)) {
        throw new RuntimeException('Folder data tidak dapat dibuat: ' . basename($folder));
    }
}

/**
 * Menulis array ke berkas JSON.
 *
 * @param array<mixed> $data
 * @throws RuntimeException bila gagal menulis.
 */
function tulisJson(string $jalur, array $data): void
{
    pastikanFolder(dirname($jalur));
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if ($json === false || file_put_contents($jalur, $json, LOCK_EX) === false) {
        throw new RuntimeException('Gagal menulis berkas: ' . basename($jalur));
    }
}

/**
 * Membaca berkas JSON menjadi array asosiatif.
 *
 * @return array<mixed>
 * @throws RuntimeException bila berkas tidak ada, tidak terbaca, atau JSON rusak.
 */
function bacaJson(string $jalur): array
{
    if (!is_file($jalur)) {
        throw new RuntimeException('Berkas tidak ditemukan: ' . basename($jalur));
    }
    $isi = file_get_contents($jalur);
    if ($isi === false) {
        throw new RuntimeException('Berkas tidak dapat dibaca: ' . basename($jalur));
    }
    $data = json_decode($isi, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
        throw new RuntimeException('JSON rusak (' . json_last_error_msg() . '): ' . basename($jalur));
    }

    return $data;
}

/**
 * Menulis baris-baris data ke CSV dengan baris judul.
 *
 * @param array<int, array<string, mixed>> $baris
 * @param array<int, string> $kolom
 */
function tulisCsv(string $jalur, array $baris, array $kolom): void
{
    pastikanFolder(dirname($jalur));
    $gagang = fopen($jalur, 'w');
    if ($gagang === false) {
        throw new RuntimeException('Gagal membuka berkas: ' . basename($jalur));
    }
    fputcsv($gagang, $kolom, ',', '"', '');
    foreach ($baris as $isi) {
        fputcsv($gagang, array_map(fn (string $k): mixed => $isi[$k] ?? '', $kolom), ',', '"', '');
    }
    fclose($gagang);
}

/**
 * Membaca CSV menjadi array baris (baris pertama = judul).
 *
 * @return array<int, array<int, string|null>>
 */
function bacaCsv(string $jalur): array
{
    $gagang = is_file($jalur) ? fopen($jalur, 'r') : false;
    if ($gagang === false) {
        throw new RuntimeException('Berkas CSV tidak dapat dibuka: ' . basename($jalur));
    }
    $hasil = [];
    while (($kolom = fgetcsv($gagang, null, ',', '"', '')) !== false) {
        $hasil[] = $kolom;
    }
    fclose($gagang);

    return $hasil;
}

/**
 * Menambah satu baris log "waktu | IP | kata kunci".
 * Pemisah dan baris baru dibuang dari kata kunci agar log tidak dapat dipalsukan.
 */
function catatLog(string $kata): void
{
    pastikanFolder(FOLDER_DATA);
    $bersih = trim((string) preg_replace('/[\r\n|]+/', ' ', $kata));
    $baris = date('Y-m-d H:i:s') . ' | ' . ($_SERVER['REMOTE_ADDR'] ?? '-') . ' | ' . $bersih . PHP_EOL;
    if (file_put_contents(FILE_LOG, $baris, FILE_APPEND | LOCK_EX) === false) {
        throw new RuntimeException('Gagal menulis log.');
    }
}

/**
 * Membaca baris log terbaru (terbaru dulu).
 *
 * @return array<int, string>
 */
function bacaLogTerakhir(int $jumlah = MAKS_BARIS_LOG): array
{
    if (!is_file(FILE_LOG)) {
        return [];
    }
    $baris = file(FILE_LOG, FILE_IGNORE_NEW_LINES);
    if ($baris === false) {
        throw new RuntimeException('Log tidak dapat dibaca.');
    }

    return array_slice(array_reverse($baris), 0, $jumlah);
}