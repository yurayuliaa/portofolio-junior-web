// Lab 1 - Linked List
import { LinkedList, LinkedQueue, Queue } from './structures.js';

const N = 100000;
const RONDE = 3;

function ujiDasar() {
  const daftar = new LinkedList();
  console.log(
    'kosong   : removeFirst =',
    daftar.removeFirst(),
    '| peekFirst =',
    daftar.peekFirst(),
  );
  daftar.addLast('B');
  daftar.addLast('C');
  daftar.addFirst('A');
  console.log('toArray  :', daftar.toArray(), '| size =', daftar.size());
  console.log(
    'find C   :',
    daftar.find((x) => x === 'C'),
    '| find Z:',
    daftar.find((x) => x === 'Z'),
  );
  console.log('removeFirst ->', daftar.removeFirst(), '|', daftar.toArray());
  const satu = new LinkedList();
  satu.addFirst('X');
  console.log(
    'satu elemen: removeFirst =',
    satu.removeFirst(),
    '| isEmpty =',
    satu.isEmpty(),
  );
}

function ujiRemove() {
  const buat = () => {
    const d = new LinkedList();
    ['A', 'B', 'C', 'D'].forEach((x) => d.addLast(x));
    return d;
  };
  for (const [nama, nilai] of [
    ['kepala', 'A'],
    ['tengah', 'C'],
    ['ekor', 'D'],
    ['tidak ada', 'Z'],
  ]) {
    const d = buat();
    const hasil = d.remove(nilai);
    console.log(
      `remove ${nama.padEnd(9)}(${nilai}) -> ${hasil}`,
      d.toArray(),
      'size =',
      d.size(),
    );
  }
  const d = buat();
  d.remove('D');
  d.addLast('E'); // tail harus sudah diperbarui setelah ekor dihapus
  console.log('addLast setelah hapus ekor :', d.toArray());
  const satu = new LinkedList();
  satu.addLast('X');
  satu.remove('X');
  satu.addLast('Y');
  console.log('hapus satu-satunya lalu tambah:', satu.toArray());
}

/** Antrean array berbasis shift() sebagai pembanding (O(n) per dequeue). */
class ArrayQueue {
  #items = [];
  enqueue(item) {
    this.#items.push(item);
  }
  dequeue() {
    return this.#items.shift();
  }
  isEmpty() {
    return this.#items.length === 0;
  }
}

function ukurAntrean(BuatAntrean) {
  const antrean = new BuatAntrean();
  for (let i = 0; i < N; i++) antrean.enqueue(i);
  const mulai = performance.now();
  while (!antrean.isEmpty()) antrean.dequeue();
  return performance.now() - mulai;
}

function bandingkanKecepatan() {
  const hasil = [];
  for (const [nama, kelas] of [
    ['Queue array (shift)', ArrayQueue],
    ['Queue head/tail (Hari 6)', Queue],
    ['LinkedQueue', LinkedQueue],
  ]) {
    const waktu = Array.from({ length: RONDE }, () => ukurAntrean(kelas));
    const rata = waktu.reduce((a, b) => a + b, 0) / RONDE;
    hasil.push({
      Antrean: nama,
      'Run 1': +waktu[0].toFixed(2),
      'Run 2': +waktu[1].toFixed(2),
      'Run 3': +waktu[2].toFixed(2),
      'Rata-rata (ms)': +rata.toFixed(2),
    });
  }
  console.log(`dequeue ${N} elemen:`);
  console.table(hasil);
}

console.log('--- 2. Uji LinkedList ---');
ujiDasar();
console.log('--- 3. remove(data) ---');
ujiRemove();
console.log('--- 4. Perbandingan kecepatan ---');
bandingkanKecepatan();