// Kasus uji minimal Proyek 3 (jalankan: node uji.js)
import assert from 'node:assert/strict';
import { Stack, LinkedList, LinkedQueue } from './js/structures.js';
import { SistemAntrean } from './js/antrian.js';
import { RiwayatEditor } from './js/riwayat.js';

let jumlahLulus = 0;
function uji(nama, isi) {
  isi();
  jumlahLulus++;
  console.log(`LULUS  ${nama}`);
}

uji('Antrean: ambil 3 nomor lalu panggil 4 kali (ke-4 kosong)', () => {
  const sistem = new SistemAntrean();
  assert.deepEqual(
    [sistem.ambilNomor(), sistem.ambilNomor(), sistem.ambilNomor()],
    ['A001', 'A002', 'A003'],
  );
  assert.equal(sistem.jumlahMenunggu(), 3);
  assert.deepEqual(
    [sistem.panggil(), sistem.panggil(), sistem.panggil()],
    ['A001', 'A002', 'A003'],
  );
  assert.equal(sistem.panggil(), null);
  assert.equal(sistem.jumlahMenunggu(), 0);
});

uji('Antrean: riwayat dibatasi 5 nomor terakhir (terbaru dulu)', () => {
  const sistem = new SistemAntrean();
  for (let i = 0; i < 7; i++) sistem.ambilNomor();
  for (let i = 0; i < 7; i++) sistem.panggil();
  assert.deepEqual(sistem.riwayatPanggilan(), [
    'A007',
    'A006',
    'A005',
    'A004',
    'A003',
  ]);
});

uji('Antrean: reset saat antrean berisi', () => {
  const sistem = new SistemAntrean();
  sistem.ambilNomor();
  sistem.ambilNomor();
  sistem.panggil();
  sistem.reset();
  assert.equal(sistem.jumlahMenunggu(), 0);
  assert.deepEqual(sistem.riwayatPanggilan(), []);
  assert.equal(sistem.ambilNomor(), 'A001');
});

uji('Riwayat: undo 3 kali lalu redo 2 kali', () => {
  const riwayat = new RiwayatEditor('');
  ['a', 'ab', 'abc'].forEach((teks) => riwayat.catat(teks));
  assert.deepEqual(
    [riwayat.undo(), riwayat.undo(), riwayat.undo()],
    ['ab', 'a', ''],
  );
  assert.equal(riwayat.undo(), null);
  assert.deepEqual([riwayat.redo(), riwayat.redo()], ['a', 'ab']);
  assert.equal(riwayat.bisaRedo(), true);
});

uji('Riwayat: mengetik setelah undo menghapus redo', () => {
  const riwayat = new RiwayatEditor('');
  riwayat.catat('a');
  riwayat.catat('ab');
  riwayat.undo();
  assert.equal(riwayat.bisaRedo(), true);
  riwayat.catat('ax');
  assert.equal(riwayat.bisaRedo(), false);
  assert.equal(riwayat.redo(), null);
});

uji('Riwayat: dibatasi 50 langkah dan teks sama tidak dicatat', () => {
  const riwayat = new RiwayatEditor('');
  for (let i = 1; i <= 60; i++) riwayat.catat(`teks ${i}`);
  assert.equal(riwayat.jumlahUndo(), 50);
  assert.equal(riwayat.catat('teks 60'), false);
});

uji('Input tidak valid ditolak dengan pesan jelas', () => {
  assert.throws(() => new RiwayatEditor('').catat(123), TypeError);
  assert.throws(() => new RiwayatEditor(null), /harus berupa string/);
  assert.throws(() => new Stack(0), RangeError);
  assert.throws(() => new Stack(-5), RangeError);
});

uji('Struktur kosong dan satu elemen aman', () => {
  const stack = new Stack();
  assert.equal(stack.pop(), undefined);
  assert.equal(stack.peek(), undefined);
  const antrean = new LinkedQueue();
  assert.equal(antrean.dequeue(), undefined);
  antrean.enqueue('X');
  assert.equal(antrean.dequeue(), 'X');
  assert.equal(antrean.isEmpty(), true);
  const daftar = new LinkedList();
  assert.equal(daftar.remove('Z'), false);
});

console.log(`\n${jumlahLulus} kelompok uji lulus`);