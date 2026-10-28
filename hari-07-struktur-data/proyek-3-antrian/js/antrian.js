/**
 * antrian.js - Logika antrean pasien (tanpa DOM), memakai LinkedQueue.
 */
import { LinkedQueue } from './structures.js';

const AWALAN_NOMOR = 'A';
const PANJANG_NOMOR = 3;
const MAKS_RIWAYAT_PANGGILAN = 5;

/** Membentuk nomor antrean, mis. 1 menjadi 'A001'. */
function formatNomor(angka) {
  return AWALAN_NOMOR + String(angka).padStart(PANJANG_NOMOR, '0');
}

/** Sistem antrean loket: ambil nomor, panggil (FIFO), riwayat, reset. */
export class SistemAntrean {
  #antrean = new LinkedQueue();
  #nomorTerakhir = 0;
  #riwayat = []; // paling baru di depan, dibatasi MAKS_RIWAYAT_PANGGILAN

  /** Mengambil nomor baru. @returns {string} nomor, mis. 'A001'. */
  ambilNomor() {
    this.#nomorTerakhir++;
    const nomor = formatNomor(this.#nomorTerakhir);
    this.#antrean.enqueue(nomor);
    return nomor;
  }

  /** Memanggil nomor terdepan. @returns {string|null} nomor, atau null bila antrean kosong. */
  panggil() {
    if (this.#antrean.isEmpty()) return null;
    const nomor = this.#antrean.dequeue();
    this.#riwayat = [nomor, ...this.#riwayat].slice(0, MAKS_RIWAYAT_PANGGILAN);
    return nomor;
  }

  /** @returns {number} jumlah pasien yang menunggu. */
  jumlahMenunggu() {
    return this.#antrean.size();
  }

  /** @returns {string[]} daftar nomor yang menunggu (depan ke belakang). */
  daftarMenunggu() {
    return this.#antrean.toArray();
  }

  /** @returns {string[]} maksimal 5 nomor terakhir yang dipanggil (terbaru dulu). */
  riwayatPanggilan() {
    return [...this.#riwayat];
  }

  /** Mengosongkan antrean, riwayat, dan menomori ulang dari awal. */
  reset() {
    this.#antrean.clear();
    this.#riwayat = [];
    this.#nomorTerakhir = 0;
  }
}