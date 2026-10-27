// Lab 5 - Mengukur Efisiensi (3 putaran, lalu rata-rata)
import { Queue } from './js/structures.js';

const N = 100000;
const RONDE = 3;

function ukur(fungsi) {
  const mulai = performance.now();
  fungsi();
  return performance.now() - mulai;
}

const pengujian = {
  'Array.includes x 1000': () => {
    const angka = Array.from({ length: N }, (_, i) => i);
    return ukur(() => { for (let i = 0; i < 1000; i++) angka.includes(N - 1); });
  },
  'Set.has x 1000': () => {
    const himpunan = new Set(Array.from({ length: N }, (_, i) => i));
    return ukur(() => { for (let i = 0; i < 1000; i++) himpunan.has(N - 1); });
  },
  'Array.shift hingga kosong': () => {
    const arr = Array.from({ length: N }, (_, i) => i);
    return ukur(() => { while (arr.length > 0) arr.shift(); });
  },
  'Queue.dequeue hingga kosong': () => {
    const q = new Queue();
    for (let i = 0; i < N; i++) q.enqueue(i);
    return ukur(() => { while (!q.isEmpty()) q.dequeue(); });
  },
};

const hasil = [];
for (const [nama, uji] of Object.entries(pengujian)) {
  const waktu = Array.from({ length: RONDE }, uji);
  const rata = waktu.reduce((a, b) => a + b, 0) / RONDE;
  hasil.push({ Operasi: nama, 'Run 1 (ms)': +waktu[0].toFixed(2), 'Run 2 (ms)': +waktu[1].toFixed(2),
    'Run 3 (ms)': +waktu[2].toFixed(2), 'Rata-rata (ms)': +rata.toFixed(2) });
}
console.log(`N = ${N}, ${RONDE} putaran`);
console.table(hasil);