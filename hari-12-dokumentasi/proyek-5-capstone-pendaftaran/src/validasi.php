<?php
/**
 * Modul     : Validasi (src/validasi.php)
 * ID Modul  : MOD-VAL-001
 * Deskripsi : Logika murni validasi dan penanganan format teruji.
 * Dependensi: -
 *
 * @package PendaftaranPelatihan
 * @author  Rahma <rahma@contoh.com>
 * @version 1.0.1
 * @since   1.0.0
 */

declare(strict_types=1);

/**
 * Memeriksa format nomor HP Indonesia (harus diawali 08, total 10 - 13 digit).
 *
 * @param string $noHp Nomor HP yang akan diperiksa.
 *
 * @return bool true jika format valid, false jika sebaliknya.
 */
function validNoHp(string $noHp): bool
{
    return preg_match('/^08[0-9]{8,11}$/', $noHp) === 1;
}

/**
 * Menghitung sisa kuota sebuah kelas agar tidak bernilai negatif.
 *
 * @param int $kuota  Kuota total kelas.
 * @param int $terisi Jumlah pendaftar saat ini.
 *
 * @return int Sisa kuota; 0 bila sudah penuh atau terlampaui.
 */
function hitungSisaKuota(int $kuota, int $terisi): int
{
    return max(0, $kuota - $terisi);
}

/**
 * Membentuk format nomor bukti pendaftaran unik.
 *
 * @param int $tahun Tahun pendaftaran (misal 2026).
 * @param int $id    ID urut pendaftaran.
 *
 * @return string Kode bukti pendaftaran dengan format REG-YYYY-XXXXXX.
 */
function formatNomorBukti(int $tahun, int $id): string
{
    return sprintf('REG-%d-%06d', $tahun, $id);
}