/**
 * structures.js - Struktur data murni (tanpa DOM): Stack, LinkedList, LinkedQueue.
 * Detail internal disembunyikan dengan private field (#).
 */

/** Simpul tunggal untuk linked list. */
class Node {
  constructor(data) {
    this.data = data;
    this.next = null;
  }
}

/** Stack (LIFO). Semua operasi O(1) (kecuali pembuangan elemen terlama saat penuh). */
export class Stack {
  #items = [];
  #maxSize;

  /**
   * @param {number} [maxSize=Infinity] batas jumlah elemen; elemen terlama dibuang bila terlampaui.
   * @throws {RangeError} bila maxSize bukan bilangan bulat positif.
   */
  constructor(maxSize = Infinity) {
    const valid =
      maxSize === Infinity || (Number.isInteger(maxSize) && maxSize > 0);
    if (!valid) throw new RangeError('maxSize harus bilangan bulat positif');
    this.#maxSize = maxSize;
  }

  /** Menaruh elemen di atas tumpukan. @param {*} item */
  push(item) {
    this.#items.push(item);
    if (this.#items.length > this.#maxSize) this.#items.shift();
  }

  /** Mengambil elemen teratas. @returns {*} elemen, atau undefined bila kosong. */
  pop() {
    return this.#items.pop();
  }

  /** Melihat elemen teratas tanpa menghapus. @returns {*} elemen, atau undefined bila kosong. */
  peek() {
    return this.#items[this.#items.length - 1];
  }

  /** @returns {boolean} true bila stack kosong. */
  isEmpty() {
    return this.#items.length === 0;
  }

  /** @returns {number} jumlah elemen. */
  size() {
    return this.#items.length;
  }

  /** Mengosongkan stack. */
  clear() {
    this.#items = [];
  }

  /** @returns {Array} salinan isi stack (bawah ke atas). */
  toArray() {
    return [...this.#items];
  }
}

/** Singly linked list dengan penunjuk tail. */
export class LinkedList {
  #head = null;
  #tail = null;
  #size = 0;

  /** Menambah data di awal, O(1). @param {*} data */
  addFirst(data) {
    const node = new Node(data);
    node.next = this.#head;
    this.#head = node;
    if (this.#tail === null) this.#tail = node;
    this.#size++;
  }

  /** Menambah data di akhir, O(1). @param {*} data */
  addLast(data) {
    const node = new Node(data);
    if (this.#tail === null) {
      this.#head = node;
    } else {
      this.#tail.next = node;
    }
    this.#tail = node;
    this.#size++;
  }

  /** Menghapus data pertama, O(1). @returns {*} data, atau undefined bila kosong. */
  removeFirst() {
    if (this.#head === null) return undefined;
    const data = this.#head.data;
    this.#head = this.#head.next;
    if (this.#head === null) this.#tail = null;
    this.#size--;
    return data;
  }

  /**
   * Menghapus node pertama yang bernilai data, O(n).
   * Menangani kepala, tengah, ekor, dan data yang tidak ada.
   * @param {*} data
   * @returns {boolean} true bila ada node yang dihapus.
   */
  remove(data) {
    let sebelumnya = null;
    let saatIni = this.#head;
    while (saatIni !== null && saatIni.data !== data) {
      sebelumnya = saatIni;
      saatIni = saatIni.next;
    }
    if (saatIni === null) return false;
    if (sebelumnya === null) this.#head = saatIni.next;
    else sebelumnya.next = saatIni.next;
    if (saatIni === this.#tail) this.#tail = sebelumnya;
    this.#size--;
    return true;
  }

  /** @returns {*} data pertama tanpa menghapus, atau undefined bila kosong. */
  peekFirst() {
    return this.#head === null ? undefined : this.#head.data;
  }

  /**
   * Mencari data pertama yang memenuhi predikat, O(n).
   * @param {function(*): boolean} predikat
   * @returns {*} data, atau undefined bila tidak ada.
   */
  find(predikat) {
    let saatIni = this.#head;
    while (saatIni !== null) {
      if (predikat(saatIni.data)) return saatIni.data;
      saatIni = saatIni.next;
    }
    return undefined;
  }

  /** @returns {number} jumlah elemen. */
  size() {
    return this.#size;
  }

  /** @returns {boolean} true bila kosong. */
  isEmpty() {
    return this.#size === 0;
  }

  /** @returns {Array} salinan isi list dari kepala ke ekor. */
  toArray() {
    const hasil = [];
    let saatIni = this.#head;
    while (saatIni !== null) {
      hasil.push(saatIni.data);
      saatIni = saatIni.next;
    }
    return hasil;
  }
}

/** Queue (FIFO) berbasis LinkedList: semua operasi O(1). */
export class LinkedQueue {
  #daftar = new LinkedList();

  /** Menambah di belakang. @param {*} item */
  enqueue(item) {
    this.#daftar.addLast(item);
  }

  /** Mengambil elemen terdepan. @returns {*} elemen, atau undefined bila kosong. */
  dequeue() {
    return this.#daftar.removeFirst();
  }

  /** @returns {*} elemen terdepan tanpa menghapus, atau undefined bila kosong. */
  front() {
    return this.#daftar.peekFirst();
  }

  /** @returns {boolean} true bila kosong. */
  isEmpty() {
    return this.#daftar.isEmpty();
  }

  /** @returns {number} jumlah elemen. */
  size() {
    return this.#daftar.size();
  }

  /** Mengosongkan antrean. */
  clear() {
    while (!this.isEmpty()) this.dequeue();
  }

  /** @returns {Array} salinan isi antrean (depan ke belakang). */
  toArray() {
    return this.#daftar.toArray();
  }
}