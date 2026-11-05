<?php
declare(strict_types=1);

/**
 * Validasi nomor HP (harus diawali 08 dan memiliki panjang total 10 - 13 digit).
 */
function validNoHp(string $noHp): bool
{
    return preg_match('/^08[0-9]{8,11}$/', $noHp) === 1;
}

/**
 * Menghitung sisa kuota agar tidak bernilai negatif.
 */
function hitungSisaKuota(int $kuota, int $terisi): int
{
    return max(0, $kuota - $terisi);
}

/**
 * Format nomor bukti pendaftaran.
 */
function formatNomorBukti(int $tahun, int $id): string
{
    return sprintf('REG-%d-%06d', $tahun, $id);
}