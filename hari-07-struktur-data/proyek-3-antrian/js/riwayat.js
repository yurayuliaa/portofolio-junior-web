/**
 * riwayat.js - Logika undo/redo editor catatan (tanpa DOM), memakai dua Stack.
 */
import { Stack } from './structures.js';

const MAKS_RIWAYAT = 50;

/** Riwayat perubahan teks dengan undo dan redo. */
export class RiwayatEditor {
  #undoStack = new Stack(MAKS_RIWAYAT);
  #redoStack = new Stack(MAKS_RIWAYAT);
  #teksSekarang;

  /**
   * @param {string} [teksAwal='']
   * @throws {TypeError} bila teksAwal bukan string.
   */
  constructor(teksAwal = '') {
    RiwayatEditor.#pastikanString(teksAwal);
    this.#teksSekarang = teksAwal;
  }

  static #pastikanString(teks) {
    if (typeof teks !== 'string') {
      throw new TypeError('Teks catatan harus berupa string');
    }
  }

  /**
   * Mencatat perubahan teks; riwayat redo dihapus.
   * @param {string} teksBaru
   * @returns {boolean} true bila teks berubah dan tercatat.
   * @throws {TypeError} bila teksBaru bukan string.
   */
  catat(teksBaru) {
    RiwayatEditor.#pastikanString(teksBaru);
    if (teksBaru === this.#teksSekarang) return false;
    this.#undoStack.push(this.#teksSekarang);
    this.#teksSekarang = teksBaru;
    this.#redoStack.clear();
    return true;
  }

  /** Membatalkan perubahan terakhir. @returns {string|null} teks baru, atau null bila tidak ada. */
  undo() {
    if (this.#undoStack.isEmpty()) return null;
    this.#redoStack.push(this.#teksSekarang);
    this.#teksSekarang = this.#undoStack.pop();
    return this.#teksSekarang;
  }

  /** Mengulang perubahan yang dibatalkan. @returns {string|null} teks baru, atau null bila tidak ada. */
  redo() {
    if (this.#redoStack.isEmpty()) return null;
    this.#undoStack.push(this.#teksSekarang);
    this.#teksSekarang = this.#redoStack.pop();
    return this.#teksSekarang;
  }

  /** @returns {boolean} true bila undo tersedia. */
  bisaUndo() {
    return !this.#undoStack.isEmpty();
  }

  /** @returns {boolean} true bila redo tersedia. */
  bisaRedo() {
    return !this.#redoStack.isEmpty();
  }

  /** @returns {number} jumlah langkah undo tersimpan. */
  jumlahUndo() {
    return this.#undoStack.size();
  }

  /** @returns {number} jumlah langkah redo tersimpan. */
  jumlahRedo() {
    return this.#redoStack.size();
  }

  /** @returns {string} teks saat ini. */
  teks() {
    return this.#teksSekarang;
  }
}