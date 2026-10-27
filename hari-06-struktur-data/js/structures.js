/**
 * structures.js - Implementasi struktur data Stack (LIFO) dan Queue (FIFO).
 * Dipakai oleh lab3, lab4, lab5, editor Undo/Redo, dan Antrean Loket.
 */

/** Stack (tumpukan): elemen terakhir masuk, pertama keluar. Semua operasi O(1). */
export class Stack {
  /**
   * @param {number} [maxSize=Infinity] batas jumlah elemen; bila terlampaui,
   *        elemen paling bawah (paling lama) dibuang.
   */
  constructor(maxSize = Infinity) {
    this.items = [];
    this.maxSize = maxSize;
  }

  /** Menaruh elemen di atas tumpukan. */
  push(item) {
    this.items.push(item);
    if (this.items.length > this.maxSize) this.items.shift(); // maxSize kecil, aman
  }

  /** Mengambil dan menghapus elemen teratas; undefined bila kosong. */
  pop() {
    return this.isEmpty() ? undefined : this.items.pop();
  }

  /** Melihat elemen teratas tanpa menghapus; undefined bila kosong. */
  peek() {
    return this.isEmpty() ? undefined : this.items[this.items.length - 1];
  }

  /** Apakah stack kosong? */
  isEmpty() {
    return this.items.length === 0;
  }

  /** Jumlah elemen. */
  size() {
    return this.items.length;
  }

  /** Mengosongkan stack. */
  clear() {
    this.items = [];
  }

  /** Salinan isi stack (bawah -> atas) tanpa membuka properti internal. */
  toArray() {
    return [...this.items];
  }
}

/** Queue (antrean): elemen pertama masuk, pertama keluar. Semua operasi O(1) (head & tail). */
export class Queue {
  constructor() {
    this.items = {};
    this.head = 0; // indeks elemen terdepan
    this.tail = 0; // indeks kosong berikutnya di belakang
  }

  /** Menambah elemen di belakang antrean. */
  enqueue(item) {
    this.items[this.tail] = item;
    this.tail++;
  }

  /** Mengambil dan menghapus elemen terdepan; undefined bila kosong. */
  dequeue() {
    if (this.isEmpty()) return undefined;
    const item = this.items[this.head];
    delete this.items[this.head];
    this.head++;
    return item;
  }

  /** Melihat elemen terdepan tanpa menghapus. */
  front() {
    return this.items[this.head];
  }

  /** Apakah antrean kosong? */
  isEmpty() {
    return this.tail === this.head;
  }

  /** Jumlah elemen. */
  size() {
    return this.tail - this.head;
  }

  /** Mengosongkan antrean. */
  clear() {
    this.items = {};
    this.head = 0;
    this.tail = 0;
  }

  /** Salinan isi antrean (depan -> belakang); menjaga enkapsulasi. */
  toArray() {
    const hasil = [];
    for (let i = this.head; i < this.tail; i++) hasil.push(this.items[i]);
    return hasil;
  }
}